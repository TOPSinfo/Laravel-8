<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Module;
use App\Models\Role;
use App\Models\Permission;
use Config;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class RoleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:list-role');
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
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
            $data = Role::select([
                "id",
                "name",
                "created_at",
                ])->selectRaw("(CASE WHEN status = 1 THEN 'Active' ELSE 'In-Active' END) AS status")->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',
                    function ($data) {
                        $actions = View::make('admin.role.actions',
                            ['role' => $data])->render();
                        return $actions;
                    })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d/m/Y H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else
        {
            return view('admin.role.index');
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

        return view('admin.role.add', compact('statusArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());
        return  redirect()->route('role.index')->with('success',trans('admin.message.created', ['module' => trans('admin.label.role')]));
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
     * @param  Role  $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $statusArr = Config::get('params.status');

        $modules = Module::with('permissions')->whereHas('permissions', function($q)  {
            $q->where('status', '=', Config::get('params.active'));
            $q->orderBy('module_id');
        })->get();

        $role = Role::with('permissions')->where('id',$role->id)->first();

        if($role->has('permissions'))
        {
            $permissions = [];
            foreach ($role->permissions as $value)
            {
                $permissions[] = $value->id;
            }
        }

        return view('admin.role.edit',compact('role','modules','permissions','statusArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRoleRequest $request
     * @param Role $role
     * @return Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $permissions = $request->get('permissions');
        if(!empty($permissions))
        {
            foreach ($permissions as $value)
            {
                $permission = new Permission();
                $permission->id = $value;
                $data[] = $permission;
            }
            $role->syncPermissions($data);
        }

        return  redirect()->route('role.index')->with('success',trans('admin.message.updated', ['module' => trans('admin.label.role')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return  redirect()->route('role.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.role')]));
    }
}
