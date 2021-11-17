<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingRule;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;

class ParkingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::label("Parking Rule List");
        return view('admin.parking-rule.index', compact('title'));
    }

    public function getParkingRuleData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $parkingRules = DB::table('parking_rules AS pkr')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'pkr.*',
        ])
            ->orderBy('pkr.name', 'DESC')
            ->whereNull('deleted_at')->get();

        $datatables = datatables()
            ->of($parkingRules)
            ->addColumn('status', function ($parkingRules) {
                if ($parkingRules->status==ParkingRule::PUBLISHED)
                    return "<span class='label label-success label-xs'>$parkingRules->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$parkingRules->status</span>";
            })
            ->addColumn('isLegal', function ($parkingRules) {
                if ($parkingRules->is_legal==ParkingRule::YES)
                    return "<span class='label label-success label-xs'>$parkingRules->is_legal</span>";
                else
                    return "<span class='label label-danger label-xs'>$parkingRules->is_legal</span>";
            })
            ->addColumn('action', function ($parkingRules) {
                return '<a href="'.route('parking-rules.edit',$parkingRules->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('parking-rules.show',$parkingRules->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status','isLegal'])
            ->setTotalRecords(count($parkingRules));

        return $datatables->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::label("New Parking Rule Creation");
        return view('admin.parking-rule.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:128|unique:parking_rules,name,NULL,id,deleted_at,NULL',
            'is_legal'=> 'max:12',
            'status'=> 'max:12'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {

            $parkingRule = new ParkingRule();
            $parkingRule->name   = $request->name;
            $parkingRule->description   = $request->description;
            $parkingRule->vehicle_restriction   = $request->vehicle_restriction;
            $parkingRule->is_legal =  ($request->is_legal?ParkingRule::YES:ParkingRule::NO);
            $parkingRule->status =  ($request->status?ParkingRule::PUBLISHED:ParkingRule::UNPUBLISHED);

            if ($request->has($request->available_date_time) && !empty($request->available_date_time))
            {
                $parkingRule->available_date_time= date('Y-m-d h:i:s',strtotime($request->available_date_time));
            }



            if ($parkingRule->save()) {
                alert()->success(Lang::label("Save Successful!"));
                return back()->withInput();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back()
                    ->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingRule  $parkingRule
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingRule $parkingRule)
    {
        if ($parkingRule->delete())
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
     * @param  \App\Models\ParkingRule  $parkingRule
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingRule $parkingRule)
    {
        $title = Lang::label("Edit Parking Rule Data");

        return view('admin.parking-rule.edit', compact('title','parkingRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingRule  $parkingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingRule $parkingRule)
    {

        $id=$request->id;
        $validator = Validator::make($request->all(), [

            'name' => "required|max:200|unique:parking_rules,name,{$id},id,deleted_at,NULL",
            'is_legal'=> 'max:12',
            'status'=> 'max:12'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {

            $parkingRule->name   = $request->name;
            $parkingRule->description   = $request->description;
            $parkingRule->vehicle_restriction   = $request->vehicle_restriction;
            $parkingRule->is_legal =  ($request->is_legal?ParkingRule::YES:ParkingRule::NO);
            $parkingRule->status =  ($request->status?ParkingRule::PUBLISHED:ParkingRule::UNPUBLISHED);

            if ($request->has($request->available_date_time) && !empty($request->available_date_time))
            {
                $parkingRule->available_date_time= date('Y-m-d h:i:s',strtotime($request->available_date_time));
            }


            if ($parkingRule->save()) {
                alert()->success(Lang::label("Update Successful!"));
                return back()->withInput();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back()
                    ->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingRule  $parkingRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingRule $parkingRule)
    {
        //
    }
}
