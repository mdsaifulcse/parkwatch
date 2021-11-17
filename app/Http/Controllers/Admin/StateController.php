<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Datatables, DB, Validator, Lang,MyHelper;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Lang::label("State List");
        return view('admin.state.index', compact('title'));
    }


    public function getCountryData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $states = DB::table('states AS s')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'countries.country_name','s.*',
        ])
            ->leftJoin('countries','countries.id','=','s.country_id')
            ->orderBy('s.state_name', 'DESC')
            ->whereNull('s.deleted_at')->get();

        $datatables = datatables()
            ->of($states)
            ->addColumn('status', function ($states) {
                if ($states->status==State::PUBLISHED)
                    return "<span class='label label-success label-xs'>$states->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$states->status</span>";
            })
            ->addColumn('action', function ($states) {
                return '<a href="'.route('states.edit',$states->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('states.show',$states->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status'])
            ->setTotalRecords(count($states));

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = Lang::label("New State Creation");
        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');
        return view('admin.state.create', compact('title','countries'));
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
            'country_id'=>'required|exists:countries,id',
            'state_name'=> 'required|max:128|unique:states,state_name,NULL,id,deleted_at,NULL',
            'status'=> 'max:12'
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        else
        {

            $state = new State();
            $state->country_id   = $request->country_id;
            $state->state_name   = $request->state_name;
            $state->status =  ($request->status?State::PUBLISHED:State::UNPUBLISHED); $request->status;



            if ($state->save()) {
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
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        if ($state->delete())
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
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $title = Lang::label("Edit State Data");
        $countries=Country::where('status',Country::PUBLISHED)->pluck('country_name','id');

        return view('admin.state.edit', compact('title','state','countries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $validator = Validator::make($request->all(), [
            'country_id'=>'required|exists:countries,id',
            'state_name'=> 'required|max:100|unique:states,state_name,'.$request->id.',id,deleted_at,NULL',
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
            $state = State::findOrFail($request->id);

            $state->country_id  = $request->country_id;
            $state->state_name  = $request->state_name;
            $state->status =  ($request->status?State::PUBLISHED:State::UNPUBLISHED); $request->status;

            if ($state->save()) {
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
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
}
