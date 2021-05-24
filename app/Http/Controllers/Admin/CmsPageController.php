<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCmsRequest;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Config;

class CmsPageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {
        $this->middleware('permission:list-cms');
        $this->middleware('permission:create-cms', ['only' => ['create','store']]);
        $this->middleware('permission:edit-cms', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-cms', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = CmsPage::get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',
                    function ($data) {
                        $actions = View::make('admin.cms.actions',
                            ['cmsPage' => $data])->render();
                        return $actions;
                    })
                ->addColumn('check',
                    function ($data) {
                        return '<input type="checkbox" id="checkbox"'.$data->id.'" name="row_id" value="'.$data->id.'">';
                    })
                ->addColumn('title',
                    function ($data) {
                        return $data->title;
                    })

                ->addColumn('slug',
                    function ($data) {
                        return $data->slug;
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
            return view('admin.cms.index');
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
        return view('admin.cms.add', compact('statusArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCmsRequest $request
     * @return Response
     */
    public function store(StoreCmsRequest $request)
    {
        $cms = CmsPage::create($request->validated());
        $cms->save();
        return  redirect()->route('cms.index')->with('success',trans('admin.message.created', ['module' => trans('admin.label.cms')]));
    }

    /**
     * Display the specified resource.
     *
     * @param CmsPage $cmsPage
     * @return Response
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
            $cmsPage = CmsPage::findOrFail($id);
            $statusArr = Config::get('params.status');
            return view('admin.cms.edit',compact('cmsPage','statusArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCmsRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreCmsRequest $request, int $id)
    {
            CmsPage::findOrFail($id)->update($request->validated());
            return  redirect()->route('cms.index')->with('success',trans('admin.message.updated', ['module' => trans('admin.label.cms')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        CmsPage::destroy([$id]);
        return  redirect()->route('cms.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.cms')]));
    }


    /**
     * Remove the multiple resources from storage.
     *
     * @param Request $request
     * @return Response
     */
    public function multipleDelete(Request $request)
    {
        if(!empty($request->get('ids')))
        {
            $ids = explode(",", $request->get('ids'));
            CmsPage::destroy($ids);
            return  redirect()->route('cms.index')->with('success',trans('admin.message.deleted', ['module' => trans('admin.label.cms')]));
        }

        return  redirect()->route('cms.index')->with('success',trans('admin.message.select_record'));

    }
}
