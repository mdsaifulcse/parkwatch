<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointSystem;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;
class PointSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    # Create a new controller instance
    public function __construct()
    {
        $this->middleware(['auth', 'roles:superadmin']);
    }

    # Show the admin list
    public function index()
    {
        $title = "Point System";
        return view('admin.point-system.list', compact('title'));
    }


    public function getPointSystemData (Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $pointSystems = DB::table('point_systems AS ps')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'ps.*',
        ])
            ->orderBy('ps.id', 'DESC')
            ->get();

        $datatables = datatables()
            ->of($pointSystems)
            ->addColumn('status', function ($pointSystems) {
                if ($pointSystems->status==PointSystem::ACTIVE)
                    return "<span class='label label-success label-xs'>Active</span>";
                else
                    return "<span class='label label-danger label-xs'>Inactive</span>";
            })
            ->addColumn('action', function ($pointSystems) {
                return '<a href="'. url("admin/point-system/$pointSystems->id".'/edit') .'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. url("admin/point-system/$pointSystems->id") .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>';
            })
            ->rawColumns(['action', 'status'])
            ->setTotalRecords(count($pointSystems));

        return $datatables->make(true);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Point System';
        return view('admin.point-system.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        $validator = Validator::make($request->all(), [
            'min_point'        => 'required|integer|between:0,999999999',
            'max_point' => 'required|integer|between:0,99999999',
            'badge_name'      => 'max:100' ,
            'status'      => 'max:2' ,
            'badge_icon'       => 'mimes:jpeg,jpg,png,gif|max:20000', //kb
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            $badgeIcon='';

            if ($request->hasFile('badge_icon')) {
                $badgeIcon=\MyHelper::photoUpload($request->file('badge_icon'),'assets/images/badge-icon',100);
            }

            PointSystem::create([
                'min_point'=>$request->min_point,
                'max_point'=>$request->max_point,
                'badge_name'=>$request->badge_name,
                'badge_icon'=>$badgeIcon,
            ]);

            alert()->success(Lang::label("Save Successful!"));
            return back()->withInput();

        }catch (Exception $e){
            alert()->error(Lang::label('Please Try Again.'));
            return redirect()->back()->withInput($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointSystem  $pointSystem
     * @return \Illuminate\Http\Response
     */
    public function show(PointSystem $pointSystem)
    {

        if (file_exists($pointSystem->badge_icon)){
            unlink($pointSystem->badge_icon);
        }


        if ($pointSystem->delete())
        {
            alert()->success(Lang::label("Delete Successful!"));
            return back();
        } else {
            alert()->error(Lang::label('Please Try Again.'));
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointSystem  $pointSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(PointSystem $pointSystem)
    {
        $title = 'Point System';
        return view('admin.point-system.edit', compact('title','pointSystem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointSystem  $pointSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointSystem $pointSystem)
    {
        //return $request;
        $validator = Validator::make($request->all(), [
            'min_point'        => 'required|integer|between:0,999999999',
            'max_point' => 'required|integer|between:0,99999999',
            'badge_name'      => 'max:100' ,
            'status'      => 'max:2' ,
            'badge_icon'       => 'mimes:jpeg,jpg,png,gif|max:20000', //kb
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            $badgeIcon=$pointSystem->badge_icon;

            if ($request->hasFile('badge_icon')) {
                $badgeIcon=\MyHelper::photoUpload($request->file('badge_icon'),'assets/images/badge-icon',100);

                if (file_exists($pointSystem->badge_icon)){
                    unlink($pointSystem->badge_icon);
                }
            }

            $pointSystem->update([
                'min_point'=>$request->min_point,
                'max_point'=>$request->max_point,
                'badge_name'=>$request->badge_name,
                'badge_icon'=>$badgeIcon,
                'status' =>  $request->status?PointSystem::ACTIVE:PointSystem::INACTIVE,
            ]);

            alert()->success(Lang::label("Update Successful!"));
            return back()->withInput();

        }catch (Exception $e){
            alert()->error(Lang::label('Please Try Again.'));
            return redirect()->back()->withInput($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointSystem  $pointSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointSystem $pointSystem)
    {
        //
    }
}
