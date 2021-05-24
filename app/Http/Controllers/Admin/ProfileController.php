<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // As it's common for every user we are not going to add any permission check
        // $this->middleware('permission:list-profile');
        // $this->middleware('permission:edit-profile', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::where(['id' => Auth::id()])->firstOrFail();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return Response
     */
    public function update(ProfileUpdateRequest $request,User $user)
    {
        $data = $request->validated();

        $user = User::where(['id' => Auth::id()])->firstOrFail();

        if ($request->has('file')) {
            if (Storage::disk('public')->exists($user->avatar)) {
                $file = public_path('storage/uploads/') . $user->avatar;
                unlink($file);
            }
            $path = $request->file->store('profile','public');
            $data['avatar'] = $path;
        }

        $user->update($data);
        return redirect()->route('profile.index')->with('success', trans('admin.message.updated', ['module' => trans('admin.label.profile')]));
    }

}
