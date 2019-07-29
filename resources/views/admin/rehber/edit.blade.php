@extends('admin.layouts.app') 

@section('content') 

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.
    <br>
    <br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- Page Header -->

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Rehber</span>
        <h3 class="page-title">Rehbere Düzenle</h3>
    </div>
</div>
<!-- End Page Header -->

<div class="row">

    <div class="col-lg-6 mb-4">
        {!! Form::model($posts, ['method' => 'PATCH','files'=>'true', 'class' => ' add-new-post', "id"=>"formId", 'route' => ['rehber.update', $posts->id]]) !!}

        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4">

            <div class="card-body p-0">
                <hr>

                <div class="form-row mx-4">
                    <label>Adı Soyadı:</label>
                    {!! Form::text('ad_soyad', null, array('placeholder' => 'Adı Soyadı','class' => 'form-control form-control-lg mb-3')) !!}
                </div>

                <div class="form-row mx-4">
                    <label>Telefon:</label>
                    {!! Form::text('telefon', null, array('placeholder' => 'Telefon','class' => 'form-control form-control-lg mb-3')) !!}
                </div>

                <div class="form-row mx-4">
                    @if ($posts->add_method == 1 )
                    <div class="bg-warning rounded text-white text-center p-3" style="box-shadow: inset 0 0 5px rgba(0,0,0,.2);">Bu Kişi Kumbara Modulunden eklenmiştir</div>
                    @else
                    <div class="bg-warning rounded text-white text-center p-3" style="box-shadow: inset 0 0 5px rgba(0,0,0,.2);">Bu Kişi bu alandan eklenmiştir</div>
                    @endif
                </div>

                <div class="card-footer border-top">
                    <a href="#" id="saveBtn" class="btn btn-sm btn-accent ml-auto d-table mr-3">Kaydet</a>
                </div>

            </div>
        </div>
        {!! Form::close() !!} 

        <!-- End Edit User Details Card -->
    </div>

    <div class="col-lg-6 mb-4">

    {!! Form::open(array('route' => 'sendSms.store', 'class' => 'form-control1 add-new-post1', "id"=>"formSmsSend", 'files'=>'true','method'=>'POST')) !!}

        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4">

            <div class="card-body p-0">
                <hr>
                <div class="form-row mx-4">
                     <h6 style="background-color:red;color:#fff;padding:5px;text-align:center"> sms gönder</h6>
                </div>

                <div class="form-row mx-4">
                
                    {!! Form::hidden('ad_soyad', $posts->ad_soyad, array('class' => 'form-control form-control-lg mb-3')) !!}
                    {!! Form::hidden('id', $posts->id, array('class' => 'form-control form-control-lg mb-3')) !!}
                </div>

                <div class="form-row mx-4">
                    {!! Form::hidden('telefon',  $posts->telefon, array('class' => 'form-control form-control-lg mb-3')) !!}
                </div>

                <div class="form-row mx-4">
                            <div class="form-group">
                                <label for="title">Taslaklar</label>
                                <select id="taslak_id" name="taslak_id" class="form-control" style="width:350px">
                                    <option value="" selected disabled>Seçiniz</option>
                                    @foreach($smsTaslaklari as $key => $smsTaslak)
                                        <option value="{{ $smsTaslak->id }}">{!! substr($smsTaslak->mesaj, 0, 120) !!} ...</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row mx-4">
                    <label>Mesaj:</label>

                    {!! Form::textarea('SendMsj', null, array('id' => 'SendMsj', 'class' => 'form-control','style'=>'height:400px')) !!}
                </div>
             

                <div class="card-footer border-top">
                    <a href="#" id="saveSmsSendBtn" class="btn btn-sm btn-accent ml-auto d-table mr-3">gonder</a>
                </div>

            </div>
        </div>
        {!! Form::close() !!} 

        <!-- End Edit User Details Card -->
    </div>

</div>

@stop
@section('scripts')
<script language="javascript" type="text/javascript">
    $("#saveSmsSendBtn").click(function() {
        $("#formSmsSend").submit();
    });

    $("#saveBtn").click(function() {
        $("#formId").submit();
    });

    $('#taslak_id').change(function() {

        var taslak_id = $(this).val();
        if (taslak_id) {
            $.ajax({
                type: "GET",
                url: "{{url('admin/get-smstaslak-list')}}?taslak_id=" + taslak_id,
                success: function(res) {
            
                    if (res) {
                        $("#SendMsj").empty();
                        $("#SendMsj").append(res);
                    

                    } else {
                        $("#SendMsj").empty();
                    }
                }
            });
        } else {
            $("#town_id").empty();
            $("#city").empty();
        }
    });
</script>

@endsection