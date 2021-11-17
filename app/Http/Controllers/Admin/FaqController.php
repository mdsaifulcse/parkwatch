<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables, DB, Validator, Lang,MyHelper;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List';
        return view('admin.faq.index', compact('title'));
    }


    public function getFaqData()
    {

        //DB::statement(DB::raw('set @rownum=0'));

        $faqs = DB::table('faqs AS f')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'f.*',
        ])
            ->orderBy('f.question', 'DESC')
            ->whereNull('deleted_at')->get();

        $datatables = datatables()
            ->of($faqs)
            ->addColumn('type', function ($faqs) {
                return str_replace('_', ' ',$faqs->type);
            })
            ->addColumn('status', function ($faqs) {
                if ($faqs->status==Faq::PUBLISHED)
                    return "<span class='label label-success label-xs'>$faqs->status</span>";
                else
                    return "<span class='label label-danger label-xs'>$faqs->status</span>";
            })
            ->addColumn('action', function ($faqs) {
                return '<a href="'.route('faqs.edit',$faqs->id).'" title="Edit" class="btn btn-xs btn-primary waves-effect"><i class="material-icons">edit</i></a>
                    <a  onclick="return confirm(\'Are you sure?\')" title="Delete" href="'. route('faqs.show',$faqs->id) .'" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">delete</i></a></a>
                  
                    ';
            })
            ->rawColumns(['action', 'status','type'])
            ->setTotalRecords(count($faqs));

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Faq,Trams & Condition, Privacy Policy Or Buddy Laws';
        $type=[
            Faq::FAQ=>Faq::FAQ,
            Faq::TERMSCONDITION=>str_replace('_',' ',Faq::TERMSCONDITION),
            Faq::PRIVACYPOLICY=>str_replace('_',' ',Faq::PRIVACYPOLICY),
            Faq::PARKINGBUDDYLAW=>str_replace('_',' ',Faq::PARKINGBUDDYLAW),
            ];
        return view('admin.faq.create', compact('title','type'));
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
            'question' => "required|max:200",
            'answer' => "required|max:1000",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            $faq= Faq::create([
                'question'=>$request->question,
                'answer'=>$request->answer,
                'type'=>$request->type,
                'status'=>Faq::PUBLISHED,
            ]);

            alert()->success(Lang::label("Save Successful!"));
            return back()->withInput();

        }catch (\Exception $e){

            alert()->error(Lang::label('Please Try Again.'));

            return back()
                ->withInput()->withErrors($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq=Faq::findOrFail($id);
        if (!empty($faq))
        {
            $faq->delete();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq=Faq::findOrFail($id);

        $title ='Edit '.str_replace('_',' ',$faq->type);
        $type=[
            Faq::FAQ=>Faq::FAQ,
            Faq::TERMSCONDITION=>str_replace('_',' ',Faq::TERMSCONDITION),
            Faq::PRIVACYPOLICY=>str_replace('_',' ',Faq::PRIVACYPOLICY),
            Faq::PARKINGBUDDYLAW=>str_replace('_',' ',Faq::PARKINGBUDDYLAW),
        ];

        return view('admin.faq.edit', compact('title','faq','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq=Faq::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'question' => "required|max:200",
            'answer' => "required|max:1000",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $input=$request->only('question','answer','status','type');

        $input['status'] =  ($request->status?Faq::PUBLISHED:Faq::UNPUBLISHED);


        try{

            $faq->update($input);

            alert()->success(Lang::label('Update Successful!'));
            return back()
                ->withInput();
        }catch (\Exception $e){

            alert()->error(Lang::label('Please Try Again.'));

            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
