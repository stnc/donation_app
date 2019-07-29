<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Kumbara;
use App\Models\Rehber;
use App\Models\SmsTaslaklari;
use Illuminate\Support\Facades\Storage;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
class RehberAdminController extends AdminController
{

    public $listing_cols = ['id', 'ad_soyad', 'telefon', 'ad', 'soyad', 'relation_id'];

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
        return view('admin.rehber.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.rehber.create');

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
            'ad_soyad' => 'required',
            'telefon' => 'required',

        ]);


        $rehber_data = [
            'ad_soyad' => $request->ad_soyad,
            'telefon' => $request->telefon,
            'add_user_id' => Auth('admin')->user()->id,
            'add_method' => 1,
            'relation_id' => 0,
        ];

        Rehber::create($rehber_data);
 

        return redirect()->route('rehber.index')
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
        $posts = Rehber::where('id', '=', $id)->first();
        $smsTaslaklari = SmsTaslaklari::all();
        return view('admin.rehber.edit', compact('posts','smsTaslaklari'));
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
                'ad_soyad' => 'required',
                'telefon' => 'required',
            ]);
            $rehber_data = [
                'ad_soyad' => $request->ad_soyad,
                'telefon' => $request->telefon,
                'add_user_id' => Auth('admin')->user()->id,
                'add_method' => 1,
                // 'relation_id' => $id,
            ];

            $Rehber = Rehber::where('id', '=',  $id);
            $Rehber->update($rehber_data);

        return redirect()->route('rehber.edit', ["id" => $id])
            ->with('success', 'Posts updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {

        Rehber::find($id)->delete();

        return redirect()->route('rehber.index')
            ->with('success', 'Posts deleted successfully');

    }


    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {

        $values = DB::table('rehber')->
        select( 'id', 'ad_soyad', 'telefon')->orderBy('id','desc');
        // ->toSql();
        // dd($values );
        $out = Datatables::of($values);
        $out->rawColumns(['id', 'action']);
        $out->addColumn('action', function ($row) {
            $output = '<a href="' . url(config('laraadmin.adminRoute') . 'admin/rehber/' . $row->id . '/edit') . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Düzenle</a>';
            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . 'rehber.destroy', $row->id], 'method' => 'delete', 'style' => 'display:inline']);
            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            $output .= Form::close();

            return $output;
        });
        return $out->make(true);
    }


}