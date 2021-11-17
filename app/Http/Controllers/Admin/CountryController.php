<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::label("Country List");
        return view('admin.country.index', compact('title'));
    }


    public function getCountryData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $countries = DB::table('countries AS c')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'c.*',
        ])
            ->orderBy('c.country_name', 'DESC')
            ->whereNull('deleted_at')->get();

        $datatables = datatables()
            ->of($countries)
            ->addColumn('status', function ($countries) {
                if ($countries->status==Country::PUBLISHED)
                    return "<span class='label label-success label-xs'>$countries->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$countries->status</span>";
            })
            ->addColumn('action', function ($countries) {
                return '<a href="'.route('countries.edit',$countries->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('countries.show',$countries->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status'])
            ->setTotalRecords(count($countries));

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::label("New Country Creation");
        return view('admin.country.create', compact('title'));
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
            'country_name'=> 'required|max:128|unique:countries,country_name,NULL,id,deleted_at,NULL',
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

            $country = new Country();
            $country->country_name   = $request->country_name;
            $country->status =  ($request->status?Country::PUBLISHED:Country::UNPUBLISHED);



            if ($country->save()) {
                alert()->success(Lang::label("Save Successful!"));
                return back()
                    ->withInput();
            } else {
                alert()->error(Lang::label('Please Try Again.'));
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country,Request $request)
    {
        if ($country->delete())
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
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $title = Lang::label("Edit Country Data");

        return view('admin.country.edit', compact('title','country'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {

        //return $request;
        $validator = Validator::make($request->all(), [
        'country_name'=> 'required|max:100|unique:countries,country_name,'.$request->id.',id,deleted_at,NULL',
        'status'=> 'max:12' ,
         ]);


        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        else
        {

            $country = Country::findOrFail($request->id);

            $country->country_name  = $request->country_name;
            $country->status =  ($request->status?Country::PUBLISHED:Country::UNPUBLISHED);

            if ($country->save()) {
                alert()->success(Lang::label('Update Successful!'));
                return back()
                    ->withInput();
            } else {
                alert()->error(Lang::label('Please Try Again.'));

                return back()->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country, Request $request)
    {

    }
}
