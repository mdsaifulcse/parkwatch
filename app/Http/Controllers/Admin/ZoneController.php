<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::label("Zone List");
        return view('admin.zone.index', compact('title'));
    }


    public function getCityData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $zone = DB::table('zones AS z')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'cities.city_name','z.*',
        ])
            ->leftJoin('cities','cities.id','=','z.city_id')
            ->orderBy('z.zone_name', 'DESC')
            ->whereNull('z.deleted_at')->get();

        $datatables = datatables()
            ->of($zone)
            ->addColumn('status', function ($zone) {
                if ($zone->status==Zone::PUBLISHED)
                    return "<span class='label label-success label-xs'>$zone->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$zone->status</span>";
            })
            ->addColumn('action', function ($zone) {
                return '<a href="'.route('zones.edit',$zone->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('zones.show',$zone->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status'])
            ->setTotalRecords(count($zone));

        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::label("New Zone Creation");

        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');


        return view('admin.zone.create', compact('title','countries'));
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
            'city_id'=>'required|exists:cities,id',
            'zone_name'=> 'required|max:128|unique:zones,zone_name,NULL,id,deleted_at,NULL',
            'status'=> 'max:12'
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        else
        {

            $zone = new Zone();
            $zone->city_id   = $request->city_id;
            $zone->zone_name   = $request->zone_name;
            $zone->status =  ($request->status?Zone::PUBLISHED:Zone::UNPUBLISHED); $request->status;



            if ($zone->save()) {
                alert()->success(Lang::label("Save Successful!"));
                return back()
                    ->withInput();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back() ->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        if ($zone->delete())
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
     * @param  \App\Models\Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = Lang::label("Edit Zone Data");

        $zone=Zone::with('city','city.state','city.state.country')->findOrFail($id);

        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');

        $states=State::where(['status'=>State::PUBLISHED,'country_id'=>$zone->city->state->country->id])->pluck('state_name','id');

        $cities=City::where(['status'=>State::PUBLISHED,'state_id'=>$zone->city->state->id])->pluck('city_name','id');

        return view('admin.zone.edit', compact('title','zone','countries','states','cities'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        $validator = Validator::make($request->all(), [
            'city_id'=>'required|exists:cities,id',
            'zone_name'=> 'required|max:100|unique:zones,zone_name,'.$request->id.',id,deleted_at,NULL',
            'status'=> 'max:12' ,
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        else
        {
            $zone = Zone::findOrFail($request->id);

            $zone->city_id  = $request->city_id;
            $zone->zone_name  = $request->zone_name;
            $zone->status =  ($request->status?Zone::PUBLISHED:Zone::UNPUBLISHED); $request->status;

            if ($zone->save()) {
                alert()->success(Lang::label('Update Successful!'));
                return back()->withInput();

            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back()->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
