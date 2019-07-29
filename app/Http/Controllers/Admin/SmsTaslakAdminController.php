<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SmsTaslaklari;

use Illuminate\Support\Facades\Storage;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
class SmsTaslakAdminController extends AdminController
{

    public $listing_cols = ['id', 'mesaj','durum'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.smsTaslak.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.smsTaslak.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {


        $this->validate($request, [
            'mesaj' => 'required',

        ]);


        $rehber_data = [
            'mesaj' => $request->mesaj,

            'add_user_id' => Auth('admin')->user()->id,
      
        ];

        SmsTaslaklari::create($rehber_data);
 

        return redirect()->route('smstaslak.index')
            ->with('success', 'Kumbara kayıt  işlemi başarı ile yapıldı ');

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id, Request $request)

    {


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        die("geçici kapalı");
        $posts = SmsTaslaklari::where('id', '=', $id)->first();


        return view('admin.smsTaslak.edit', compact('posts'));


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     */

    public function update(Request $request, $id)

    {




$this->validate($request, [
    'mesaj' => 'required',
 

]);



$rehber_data = [
    'mesaj' => $request->mesaj,
  
    'add_user_id' => Auth('admin')->user()->id,


];


$Rehber = SmsTaslaklari::where('id', '=',  $id);
$Rehber->update($rehber_data);




        return redirect()->route('smstaslak.edit', ["id" => $id])
            ->with('success', 'Posts updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id )

    {
    
        $post =SmsTaslaklari::where('id',$id)->firstOrFail();
        $post->delete();


    

        return redirect()->route('smstaslak.index')
            ->with('success', 'Sms taslak başarı ile silindi');

    }


    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {

        $values = DB::table('sms_taslaklari')->
        select( 'id', 'mesaj', 'durum')->
        where( 'deleted_at', '=', null);
        // ->toSql();
        // dd($values );
        $out = Datatables::of($values);
        $out->rawColumns(['id', 'action']);
        $out->addColumn('action', function ($row) {
            // $output = '<a href="' . url(config('laraadmin.adminRoute') . 'admin/smstaslak/' . $row->id . '/edit') . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Düzenle</a>';
            $output = Form::open(['route' => [config('laraadmin.adminRoute') . 'smstaslak.destroy', $row->id], 'method' => 'delete', 'style' => 'display:inline']);
            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            $output .= Form::close();

            return $output;
        });
        return $out->make(true);
    }


}
