<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\ParkingRule;
use App\Models\State;
use App\Models\Zone;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Setting;
use Validator, DB, Str, Lang;

class PlaceController extends Controller
{    

	public function __construct()
    {
        $this->middleware(['auth']);
    }

    # Show the Parking Zone
    public function list()
    {
        $title = Lang::label('Parking Spot');

        $places = New Place();

        if (auth()->user()->user_role==User::PARKING_OWNER)
        {
            $places=$places->where(['user_id'=>auth()->user()->id]);
        }
        $places =$places->get();
        return view('admin.place.list', compact('title', 'places'));
    }

    public function getListData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $places = DB::table('place')->select([
             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'user_id',
            'name',
            'address',
            'latitude',
            'longitude',
            'limit',
            'space',
            'note',
            'status'
        ])->orderBy('id', 'asc');


        if (auth()->user()->user_role==User::PARKING_OWNER)
        {
            $places=$places->where('user_id',auth()->user()->id);
        }

        $places=$places->get();

 
        $datatables = datatables()
            ->of($places)
            ->addColumn('space', function ($place) {
                return Str::words($place->space,2);
            })
            ->addColumn('status', function ($place) {
                return '<div class="switch" >
                        <label>
                        <input disabled name="status" type="checkbox" '.(($place->status==1)?'checked':null).'>
                            <span class="lever"></span>
                        </label>
                    </div>';
            })
            ->addColumn('action', function ($place) {
                return '<a href="'. url("admin/place/show/$place->id") .'" class="btn btn-xs btn-success waves-effect"><i class="material-icons">remove_red_eye</i></a>
                    <a href="'. url("admin/place/edit/$place->id") .'" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" href="'. url("admin/place/delete/$place->id") .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>';
            })
            ->rawColumns(['action',  'status'])
            ->removeColumn('password')
            ->setTotalRecords(count($places)); 

        return $datatables->make(true); 
    }



    # Show the parking Zone form. 
    public function form()
    {
    	$title = Lang::label('New Parking Spot');
    	$setting = Setting::first();
        $countries=Country::where('status',Country::PUBLISHED)->orderBy('id','DESC')->pluck('country_name','id');
        $users=[];
        if (auth()->user()->user_role==User::SUPERADMIN || auth()->user()->user_role==User::ADMIN)
        {
            $users=User::where(['status'=>1,'user_role'=>User::PARKING_OWNER])->orderBy('id','DESC')->pluck('name','id');
        }
        $parkingRules=ParkingRule::where(['status'=>ParkingRule::PUBLISHED])->orderBy('id','DESC')->pluck('name','id');
        return view('admin.place.form', compact('title', 'setting','countries','users','parkingRules'));
    }


    # Save the parking Zone data
    public function create(Request $request)
    {

        if (auth()->user()->user_role==User::PARKING_OWNER)
        {
            $request['user_id']=auth()->user()->id;
        }

        $validator = Validator::make($request->all(), [ 
            'user_id'        => 'required|exists:users,id',
            'zone_id'        => 'required|exists:zones,id',
            'parking_rule_id'  => 'required|exists:parking_rules,id',
            'name'        => 'required|max:255',
            'address'     => 'required|max:255',
            'latitude'    => 'required|max:50',
            'longitude'   => 'required|max:50',
            'limit'       => 'required|min:1',
            'space'     => 'required',
            'note'        => 'max:2048', 
            'available_from'        => 'required',
            'available_to'        => 'required',
        ]);
  
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
            
            $place = new Place;
            $place->user_id= $request->user_id;
            $place->zone_id= $request->zone_id;
            $place->parking_rule_id = $request->parking_rule_id;
            $place->name      = $request->name;
            $place->address   = $request->address;
            $place->latitude  = $request->latitude;
            $place->longitude = $request->longitude; 
            $place->limit     = $request->limit; 
            $place->note      = $request->note;
            $place->space     = $request->space; 
            $place->status    = ($request->status==1?1:0); 
            $place->available_from    = (!empty($request->available_from)? date('Y-m-d H:i',strtotime($request->available_from)) :null);
            $place->available_to    = (!empty($request->available_to)? date('Y-m-d H:i',strtotime($request->available_to)) :null);

            if ($place->save()) {
                alert()->success(Lang::label("Save Successful!"));
                return redirect()->back();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

    }


    # Show place data by id
    public function show(Request $request)
    {
        $title ='Parking Spot';
        $place = Place::with('zone')->findOrFail($request->id);
        $setting = Setting::first();
        return view('admin.place.show', compact('title', 'place', 'setting'));
    } 


    # Show the parking place by id. 
    public function edit(Request $request)
    {
        $title = 'Edit Parking Spot';
        $place = Place::with('client','zone','zone.city','zone.city.state','zone.city.state.country')->findOrFail($request->id);
        $setting = Setting::first();
        $countries=Country::where('status',Country::PUBLISHED)->orderBy('id','DESC')->pluck('country_name','id');
        $users=[];
        if (auth()->user()->user_role==User::SUPERADMIN || auth()->user()->user_role==User::ADMIN)
        {
            $users=User::where(['status'=>1,'user_role'=>User::PARKING_OWNER])->orderBy('id','DESC')->pluck('name','id');
        }

        $parkingRules=ParkingRule::where(['status'=>ParkingRule::PUBLISHED])->orderBy('id','DESC')->pluck('name','id');



        $states=State::where(['status'=>State::PUBLISHED,'country_id'=> !is_null($place->zone)?$place->zone->city->state->country->id:''])->pluck('state_name','id');


        $cities=City::where(['status'=>City::PUBLISHED,'state_id'=>!is_null($place->zone)? $place->zone->city->state->id:''])->pluck('city_name','id');


        $zones=Zone::where(['status'=>Zone::PUBLISHED,'city_id'=>!is_null($place->zone)?$place->zone->city->id:''])->orderBy('id','DESC')->pluck('zone_name','id');

//        if (!empty($place->zone)){
//            return '123';
//        }else{
//            return '456';
//        }

        return view('admin.place.edit', compact('title', 'place', 'setting','countries','states','cities','zones','users','parkingRules'));
    }

    # Update the parking place data
    public function update(Request $request)
    {
        if (auth()->user()->user_role==User::PARKING_OWNER)
        {
            $request['user_id']=auth()->user()->id;
        }

        $validator = Validator::make($request->all(), [
            'user_id'        => 'nullable|exists:users,id',
            'zone_id'        => 'required|exists:zones,id',
            'parking_rule_id'  => 'required|exists:parking_rules,id',
            'name'        => 'required|max:255',
            'address'     => 'required|max:255',
            'latitude'    => 'required|max:50',
            'longitude'   => 'required|max:50',
            'limit'       => 'required|min:1',
            'space'     => 'required',
            'note'        => 'max:2048',
            'available_from'        => 'required',
            'available_to'        => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {  
            
            $place = Place::findOrFail($request->id);
            $place->user_id= $request->user_id;
            $place->zone_id= $request->zone_id;
            $place->parking_rule_id = $request->parking_rule_id;
            $place->name      = $request->name;
            $place->address   = $request->address;
            $place->latitude  = $request->latitude;
            $place->longitude = $request->longitude; 
            $place->limit     = $request->limit; 
            $place->note      = $request->note;
            $place->space   = $request->space; 
            $place->status    = ($request->status?1:0);
            $place->available_from    = (!empty($request->available_from)? date('Y-m-d H:i',strtotime($request->available_from)) :null);
            $place->available_to    = (!empty($request->available_to)? date('Y-m-d H:i',strtotime($request->available_to)) :null);

            if ($place->save()) {
                alert()->success(Lang::label('Update Successful!'));
                return back();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }
        }
    }

    # Delete place data by id
    public function delete(Request $request)
    {
        $place = Place::findOrFail($request->id);
        if ($place->delete())
        {
            alert()->success(Lang::label("Delete Successful!"));
            return back();
        } else {
            alert()->error(Lang::label('Please Try Again.'));
            return back();
        }
    } 


}
