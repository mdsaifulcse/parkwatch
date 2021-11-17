<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biggapon;
use Illuminate\Http\Request;
use DB,Auth,Validator,MyHelper,Route,Lang;

class BiggaponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $max_serial=Biggapon::max('serial_num')+1;
        $title = 'Biggapon';
        return view('admin.biggapon.list',compact('max_serial','title'));
    }


    public function getBiggaponData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $biggapons = DB::table('biggapons AS b')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'b.*',
        ])
            ->orderBy('b.id', 'DESC')
            ->whereNull('deleted_at')->get();

        $datatables = datatables()
            ->of($biggapons)

            ->addColumn('image', function ($biggapons) {

                return '<img src=" '.asset('public'.$biggapons->image?$biggapons->image:"public/assets/images/icons/user.png").' " width="60" height="40" />';

            })

            ->addColumn('status', function ($biggapons) {
                if ($biggapons->status==Biggapon::ACTIVE)
                    return "<span class='label label-success label-xs'>$biggapons->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$biggapons->status</span>";
            })
            ->addColumn('action', function ($biggapons) {
                return '<a href="'.route('biggapons.edit',$biggapons->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>

                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('biggapons.show',$biggapons->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                    
                    
                    
                    ';
            })
            ->rawColumns(['action', 'status','image'])
            ->setTotalRecords(count($biggapons));

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_serial=Biggapon::max('serial_num')+1;
        $title = 'Biggapon';
        $places=[
            Biggapon::TOP=>Biggapon::TOP,
            Biggapon::MIDDLE=>Biggapon::MIDDLE,
            Biggapon::BOTTOM=>Biggapon::BOTTOM,
        ];
        return view('admin.biggapon.form',compact('max_serial','title','places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'place'=> 'required',
            'image'=> 'required|mimes:jpg,jpeg,png,webp,gif,bmp',
            'show_on_page'=> 'nullable',
            'serial_num'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            //return $request;
            if ($request->status==1){
                $input['status']=Biggapon::ACTIVE;
            }else{
                $input['status']=Biggapon::INACTIVE;
            }

            if ($request->target_url==null){
                $input['target_url']='#';
            }
            if ($request->show_on_page==null){
                $input['show_on_page']=Biggapon::HOME_PAGE;
            }

            if ($request->hasFile('image')){
                $input['image']=\MyHelper::fileUpload($request->file('image'),'images/biggapon/');
            }

            if ($request->active_till){
                $input['active_till']=date('Y-m-d',strtotime($request->active_till));
            }

            Biggapon::create($input);

            alert()->success(Lang::label("Save Successful!"));
            return redirect()->back();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];

            alert()->error(Lang::label('Please Try Again.'));

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biggapon  $biggapon
     * @return \Illuminate\Http\Response
     */
    public function show(Biggapon $biggapon)
    {

        if ($biggapon->delete())
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
     * @param  \App\Models\Biggapon  $biggapon
     * @return \Illuminate\Http\Response
     */
    public function edit(Biggapon $biggapon)
    {
        $title = 'Biggapon';
        $places=[
            Biggapon::TOP=>Biggapon::TOP,
            Biggapon::MIDDLE=>Biggapon::MIDDLE,
            Biggapon::BOTTOM=>Biggapon::BOTTOM,
            ];
        return view('admin.biggapon.edit',compact('title','places','biggapon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Biggapon  $biggapon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'place'=> 'required',
            'image'=> 'nullable|mimes:jpg,jpeg,png,webp,gif,bmp',
            'show_on_page'=> 'nullable',
            'serial_num'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $biggapon=Biggapon::findOrFail($id);


        try{

            //return $request;
            if ($request->has('status')){
                $input['status']=Biggapon::ACTIVE;
            }else{
                $input['status']=Biggapon::INACTIVE;
            }

            if ($request->target_url==null){
                $input['target_url']='#';
            }

            if ($request->target_url==null){
                $input['target_url']='#';
            }

            if ($request->hasFile('image')){

                {
                    $input['image']=\MyHelper::fileUpload($request->file('image'),'images/biggapon/');
                }

                if (file_exists($biggapon->image)){
                    unlink($biggapon->image);
                }
            }


            if ($request->active_till){
                $input['active_till']=date('Y-m-d',strtotime($request->active_till));
            }

            $input['updated_by']=Auth::user()->id;
            $biggapon->update($input);

            alert()->success(Lang::label("Update Successful!"));
            return redirect()->back();
        }catch(Exception $e){
            alert()->error(Lang::label('Please Try Again.'));

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biggapon  $biggapon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biggapon $biggapon,$id)
    {
        $data=Biggapon::findOrFail($id);

        DB::beginTransaction();
        try {

            $data->delete();

//            if (file_exists($input->image)){
//                unlink($input->image);
//            }

            $bug = 0;
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if ($bug == 0) {
            return redirect()->back()->with('success', ' Biggapon Deleted Successfully.');
        }elseif ($bug==1451){
            return redirect()->back()->with('error', 'Sorry this users can not be delete due to used another module');
        }
        else {
            return redirect()->back()->with('error', 'Something Error Found! ' . $bug1);
        }
    }
}