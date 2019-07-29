<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SmsTaslaklari;
use App\Models\GidenSms;

use Illuminate\Support\Facades\Storage;
use Datatables;
use DB;
use Hash;
use Collective\Html\FormFacade as Form;
class SendSmsAdminController extends AdminController
{

    public $listing_cols = ['id', 'mesaj', 'durum'];

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

        // $password = '';
        // $hashedPassword = Hash::make($password);
        // echo $hashedPassword;
        // die;
    
        $this->validate($request, ['SendMsj' => 'required']);

        $postUrl = "http://api.tescom.com.tr:8080/api/smspost/v1";
        $postData = "" . "<sms>" . "<username>Evfa</username>" . "<password>cb0dd2cc1fb31b103ceb336f937e5eb0</password>" . "<header>EVFA</header>" . "<validity>2880</validity>" . "<message>" . "<gsm>" . "<no>" . $request->telefon . "</no>" . "</gsm>" . "<msg><![CDATA[" . $request->SendMsj . "]]></msg>" . "</message>" . "</sms>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
            "Content-Type: text/xml; charset=UTF-8"
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        // echo $response;
        $pieces = explode(" ", $response);

        if ($pieces[0] == "00")
        {
            //giden sms tablusna kaydolacak
            $data = ['mesaj' => $request->SendMsj, 
            'sms_taslak_id' => $request->taslak_id, 
            'rehber_id' => $request->id, 
            'telefon' => $request->telefon, 
            'sms_dlrId' => $pieces[1], 
            'add_user_id' => Auth('admin')->user()->id,
            ];
            //
            GidenSms::create($data);

            return redirect()->route('rehber.index')
                ->with('success', 'Kumbara kayıt  işlemi başarı ile yapıldı ');
        }
        else
        {
            return redirect()
                ->route('rehber.index')
                ->with('success', 'bir sorun oluştu sms için dönen hata kodu ' . $pieces[0]);
        }

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

        $this->validate($request, ['mesaj' => 'required',

        ]);

        $rehber_data = ['mesaj' => $request->mesaj,

        'add_user_id' => Auth('admin')
            ->user()->id,

        ];

        $Rehber = SmsTaslaklari::where('id', '=', $id);
        $Rehber->update($rehber_data);

        return redirect()->route('smstaslak.edit', ["id" => $id])->with('success', 'Posts updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {

        $post = SmsTaslaklari::where('id', $id)->firstOrFail();
        $post->delete();

        return redirect()
            ->route('smstaslak.index')
            ->with('success', 'Sms taslak başarı ile silindi');

    }

    //  ajax
    public function getSmsTaslakList(Request $request)
    {
        $data = DB::table("sms_taslaklari")->where("id", $request->taslak_id)
            ->where('deleted_at', '=', null)
            ->pluck("mesaj")
            ->first();
        return ($data);

    }

    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {

        $values = DB::table('sms_taslaklari')->select('id', 'mesaj', 'durum')
            ->where('deleted_at', '=', null);
        // ->toSql();
        // dd($values );
        $out = Datatables::of($values);
        $out->rawColumns(['id', 'action']);
        $out->addColumn('action', function ($row)
        {
            // $output = '<a href="' . url(config('laraadmin.adminRoute') . 'admin/smstaslak/' . $row->id . '/edit') . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Düzenle</a>';
            $output = Form::open(['route' => [config('laraadmin.adminRoute') . 'smstaslak.destroy', $row->id], 'method' => 'delete', 'style' => 'display:inline']);
            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            $output .= Form::close();

            return $output;
        });
        return $out->make(true);
    }

}

