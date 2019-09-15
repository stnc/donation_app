<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kumbara;
use App\Models\Rehber;
use Collective\Html\FormFacade as Form;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KumbaraAdminController extends AdminController
{

    public $listing_cols = ['id', 'rehber_id', 'il_id', 'ilce_id', 'referans', 'miktar', 'meslek', 'email', 'aciklama'];

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
        return view('admin.kumbara.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $citys = \App\Models\City::all();
        $townList = \App\Models\Town::all();
        $rehbers = \App\Models\Rehber::all();
        return view('admin.kumbara.create', compact('citys', 'townList','rehbers'));

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
            'rehber_id' => 'required',
            'town_id' => 'required',
            'city_id' => 'required',
        ]);

        $kumbara_data = [

            'rehber_id' => $request->rehber_id,
            'miktar' => $request->miktar,
            'meslek' => $request->meslek,
            'email' => $request->email,
            'aciklama' => $request->aciklama,
            'town_id' => $request->town_id,
            'city_id' => $request->city_id,
            'add_user_id' => Auth('admin')->user()->id,
        ];

        $kukmbara = Kumbara::create($kumbara_data);

        return redirect()->route('kumbara.index')
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

        $posts = Posts::find($id);
        $tags = ($posts->tags()->get());
        $comments = ($posts->comments()->get());
        return view('admin.kumbara.show', compact('posts', 'tags', "comments"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $kumbara = Kumbara::where('id', '=', $id)->first();

        $citys = \App\Models\City::all();

        $rehbers = \App\Models\Rehber::all();

        $townList = \App\Models\Town::where('CityID', '=', $kumbara->city_id)->get();

        return view('admin.kumbara.edit', compact('citys', 'townList', 'kumbara','rehbers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Responseç*. ü-
     *
     */

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'rehber_id' => 'required',
            'town_id' => 'required',
            'city_id' => 'required',
        ]);

        $kumbara_data = [
            'rehber_id' => $request->rehber_id,
            'referans' => $request->referans,
            'miktar' => $request->miktar,
            'meslek' => $request->meslek,
            'email' => $request->email,
            'aciklama' => $request->aciklama,
            'town_id' => $request->town_id,
            'city_id' => $request->city_id,
            'add_user_id' => Auth('admin')->user()->id,
        ];
        $kukmbara = Kumbara::find($id);
        $kukmbara->update($kumbara_data);



        return redirect()->route('kumbara.edit', ["id" => $id])
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

        Kumbara::find($id)->delete();

        return redirect()->route('kumbara.index')
            ->with('success', 'Posts deleted successfully');

    }

    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {

        $values = DB::table('kumbara')->
            select('kumbara.id as kumbara_id', 'city.CityName as ilAdi',
            'town.TownName as ilceAdi', 'rehber.ad_soyad', 'rehber.telefon', 'miktar')
            ->join('city', 'city.CityID', '=', 'kumbara.city_id')
            ->join('rehber', 'rehber.id', '=', 'kumbara.rehber_id')
            ->join('town', 'town.TownID', '=', 'kumbara.town_id');
        // ->toSql();
        // dd($values );
        $out = Datatables::of($values);
        $out->rawColumns(['id', 'action']);
        $out->addColumn('action', function ($row) {
            $output = '<a href="' . url(config('laraadmin.adminRoute') . 'admin/kumbara/' . $row->kumbara_id . '/edit') . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Düzenle</a>';
            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . 'kumbara.destroy', $row->kumbara_id], 'method' => 'delete', 'style' => 'display:inline']);
            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            $output .= Form::close();

            return $output;
        });
        return $out->make(true);
    }

    //ajax method
    public function getStateList(Request $request)
    {
        $states = DB::table("town")
            ->where("CityID", $request->city_id)
            ->pluck("TownName", "TownID");
        return response()->json($states);
    }



}
