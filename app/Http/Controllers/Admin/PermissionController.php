<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Models\Module;
use App\Models\Permission;
use Config;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Auth;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {
        $this->middleware('permission:list-permission');
        $this->middleware('permission:create-permission', ['only' => ['create','store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Permission::with('module')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',
                    function ($data) {
                        $actions = View::make('admin.permission.actions',
                            ['permission' => $data])->render();
                        return $actions;
                    })
                ->addColumn('name',
                    function ($data) {
                        return $data->name;
                    })
                ->addColumn('module_name',
                    function ($data) {
                        return $data->module !== null ? $data->module->name : '';
                    })
                ->addColumn('status', function ($data) {
                    return $data->status == 1 ? 'Active' : 'In-active';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d/m/Y H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else
        {
            return view('admin.permission.index');
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
        $modules = Module::latest()->get();
        return view('admin.permission.add', compact('statusArr','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return Response
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        $permission->syncRoles(Config::get('params.admin_roles'));
        return  redirect()->route('permission.index')->with('success',trans('admin.message.created', ['module' => trans('admin.label.permission')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        $statusArr = Config::get('params.status');
        $modules = Module::latest()->get();
        return view('admin.permission.edit',compact('permission','statusArr','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePermissionRequest $request
     * @param  Permission  $permission
     * @return Response
     */
    public function update(StorePermissionRequest $request, Permission  $permission)
    {
        $permission->update($request->validated());
        return  redirect()->route('permission.index')->with('success',trans('admin.message.updated', ['module' => trans('admin.label.permission')]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function destroy(Permission  $permission)
    {
        $permission->delete();
        return  redirect()->route('permission.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.permission')]));
    }
}
