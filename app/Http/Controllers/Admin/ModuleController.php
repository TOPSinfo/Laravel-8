<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Config;
use Illuminate\Database\QueryException;

class ModuleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {
        $this->middleware('permission:list-module');
        $this->middleware('permission:create-module', ['only' => ['create','store']]);
        $this->middleware('permission:edit-module', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-module', ['only' => ['destroy']]);
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
            $data = Module::select([
                "id",
                "name",
                "created_at"
                ])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',
                    function ($data) {
                        $actions = View::make('admin.module.actions',
                            ['module' => $data])->render();
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
            return view('admin.module.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('admin.module.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModuleRequest $request
     * @return Response
     */
    public function store(StoreModuleRequest $request)
    {
        try {
            $module = Module::create($request->validated());
            $defaultPermissions = Config::get('params.module_default_permissions');

            if($request->has('default_permission'))
            {
                $data = [];
                foreach ($defaultPermissions as $value)
                {
                    $name = str_replace(" ","-",trim($request->get('name')));
                    $permission = new Permission();
                    $permission->name = strtolower($value.'-'.$name);
                    $permission->status = Config::get('params.active');
                    $data[] = $permission;
                }

                $module->permissions()->saveMany($data);
            }

            return  redirect()->route('module.create')->with('success',trans('admin.message.created', ['module' => trans('admin.label.module')]));
        } catch(QueryException $ex){

            if($ex->errorInfo[1] == 1062) {
                return  redirect()->route('module.create')->with('success',trans('admin.message.unique', ['field' => trans('admin.label.name')]));
            } else {
                return  redirect()->route('module.create')->with('error',trans('admin.message.error'));
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Module  $module
     * @return Response
     */
    public function show(Module $module)
    {
        return view('admin.module.edit',compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Module  $module
     * @return Response
     */
    public function edit(Module $module)
    {
        return view('admin.module.edit',compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreModuleRequest $request
     * @param Module $module
     * @return Response
     */
    public function update(StoreModuleRequest $request, Module $module)
    {
        $module->update($request->validated());
        return  redirect()->route('module.index')->with('success',trans('admin.message.updated', ['module' => trans('admin.label.module')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Module  $module
     * @return Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return  redirect()->route('module.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.module')]));
    }
}
