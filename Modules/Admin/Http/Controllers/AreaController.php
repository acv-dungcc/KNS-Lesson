<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Repositories\Area\AreaEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use UserEloquentRepository;

class AreaController extends Controller
{
    protected $repository;
    public function __construct(AreaEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::user.pagination',
            [
                'users' => $this->repository->getObjects($per_page, $search),
                'pages'       => $this->repository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = 10;
        $areas =  Area::all();
        $pages = $this->repository->getPages($records);
        return view('admin::areas.index', compact('areas','pages'));
    }

    /**
     * show a area
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $area = Area::findOrFail ($id);
        return view('admin::areas.show',compact('area'));
    }

    /**
     * edit a area
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $area =  Area::findOrFail($id);
        return view ('admin::areas.edit', compact('area'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $area = Area::findOrFail($id);

        $area->name        = $request->name;
        $area->description = $request->description;

        $area->save();
        Session::flash('message', 'Successfully updated area!');
        return redirect('admin/area/index');
    }

    /**
     * creat a area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin::areas.create');
    }

    /**
     * store a area
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $area = new Area();
        $area->name        = $request->name;
        $area->description = $request->description;
        $area->save();

        Session::flash('message', 'Successfully created area!');
        return redirect('admin/area/index');
    }

    public function delete($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
    }

}
