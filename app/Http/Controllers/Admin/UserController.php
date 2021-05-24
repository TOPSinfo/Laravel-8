<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\View;
use Config;
use Auth;
use JCryption;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {
        $this->middleware('permission:list-user');
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::with('role')->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',
                    function ($data) {
                        $actions = View::make('admin.user.actions',
                            ['user' => $data])->render();
                        return $actions;
                    })
                ->addColumn('check',
                    function ($data) {
                        return '<input type="checkbox" id="checkbox"'.$data->id.'" name="row_id" value="'.$data->id.'">';
                    })
                ->addColumn('name',
                    function ($data) {
                        return $data->name;
                    })

                ->addColumn('email',
                    function ($data) {
                        return $data->email;
                    })
                ->addColumn('role',
                    function ($data) {
                        return $data->role->name;
                    })
                ->addColumn('gender',
                    function ($data) {
                        return $data->gender;
                    })
                ->addColumn('status', function ($data) {
                    return $data->status == 1 ? 'Active' : 'In-active';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at != null ? $data->created_at->format('d/m/Y H:i:s'):'';
                })

                ->rawColumns(['action','check'])
                ->make(true);
        }
        else
        {
            return view('admin.user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statusArr = Config::get('params.status');
        $genders = Config::get('params.gender');
        $roles = Role::where(['status' => Config::get('params.active')])->select(['id','name'])->get();
        return view('admin.user.add', compact('statusArr','roles','genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return Response
     */
    public function store(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt('secret');
        if ($request->has('file')) {
            $path = $request->file->store('profile','public');
            $data['avatar'] = $path;
        }

        $user = User::create($data);

        // Assign Roles to User
        $user->syncRoles($user->role->name);
        return  redirect()->route('user.index')->with('success',trans('admin.message.created', ['module' => trans('admin.label.user')]));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $statusArr = Config::get('params.status');
        $genders = Config::get('params.gender');
        $roles = Role::where(['status' => Config::get('params.active')])->select(['id','name'])->get();
        return view('admin.user.edit', compact('user','roles','genders','statusArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //$user->syncRoles(['writer', 'admin']);
        $data = $request->validated();

        if ($request->has('file')) {
            if (Storage::disk('public')->exists($user->avatar)) {
                $file = public_path('storage/uploads/') . $user->avatar;
                unlink($file);
            }
            $path = $request->file->store('profile','public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        // Assign Roles to User
        $user->syncRoles($user->role->name);

        return  redirect()->route('user.index')->with('success',trans('admin.message.updated', ['module' => trans('admin.label.user')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return  redirect()->route('user.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.user')]));
    }


    public function multipleDelete(Request $request)
    {
        if(!empty($request->get('ids')))
        {
            $ids = explode(",", $request->get('ids'));
            User::destroy($ids);
            return  redirect()->route('user.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.user')]));
        }

        return  redirect()->route('user.index')->with('success',trans('admin.message.select_record'));

    }

}
