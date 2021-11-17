<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::label("City List");
        return view('admin.city.index', compact('title'));
    }


    public function getCityData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $city = DB::table('cities AS c')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'states.state_name','c.*',
        ])
            ->leftJoin('states','states.id','=','c.state_id')
            ->orderBy('c.city_name', 'DESC')
            ->whereNull('c.deleted_at')->get();

        $datatables = datatables()
            ->of($city)
            ->addColumn('status', function ($city) {
                if ($city->status==City::PUBLISHED)
                    return "<span class='label label-success label-xs'>$city->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$city->status</span>";
            })
            ->addColumn('action', function ($city) {
                return '<a href="'.route('cities.edit',$city->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('cities.show',$city->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status'])
            ->setTotalRecords(count($city));

        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::label("New City Creation");
        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');
        return view('admin.city.create', compact('title','countries'));
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
            'state_id'=>'required|exists:states,id',
            'city_name'=> 'required|max:128|unique:cities,city_name,NULL,id,deleted_at,NULL',
            'status'=> 'max:12'
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        else
        {

            $city = new City();
            $city->state_id   = $request->state_id;
            $city->city_name   = $request->city_name;
            $city->status =  ($request->status?City::PUBLISHED:City::UNPUBLISHED); $request->status;



            if ($city->save()) {
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
    public function show(City  $city)
    {
        if ($city->delete())
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city=City::with('state','state.country')->findOrFail($id);
        $title = Lang::label("Edit City Data");

        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');
        $states=State::where(['status'=>State::PUBLISHED,'country_id'=>$city->state->country->id])->pluck('state_name','id');

        return view('admin.city.edit', compact('title','city','countries','states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City  $city)
    {
        $validator = Validator::make($request->all(), [
            'state_id'=>'required|exists:states,id',
            'city_name'=> 'required|max:100|unique:cities,city_name,'.$request->id.',id,deleted_at,NULL',
            'status'=> 'max:12' ,
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            $city = City::findOrFail($request->id);

            $city->state_id  = $request->state_id;
            $city->city_name  = $request->city_name;
            $city->status =  ($request->status?City::PUBLISHED:City::UNPUBLISHED); $request->status;

            if ($city->save()) {
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
