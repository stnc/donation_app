@extends('admin.layouts.app') @section('content') @if (count($errors) > 0)
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
        <h3 class="page-title">Rehbere Ekle</h3>
    </div>
</div>
<!-- End Page Header -->

{!! Form::open(array('route' => 'rehber.store', 'class' => 'form-control1 add-new-post1', "id"=>"formId", 'files'=>'true','method'=>'POST')) !!}
<div class="row">

    <div class="col-lg-6 mb-4">
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
                    <label>Adres:</label>
                    {!! Form::textarea('adres', null, array('placeholder' => 'Adres','class' => 'form-control form-control-lg mb-3')) !!}
             </div>

      
                <p>
                    <p>
                        <p>

            </div>

        </div>
        <!-- End Edit User Details Card -->
    </div>

    <div class="col-lg-6 mb-4">
        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4">

            <div class="card-body p-0">


            <div class="form-row mx-4">
                    <label>Referans:</label>
                    {!! Form::textarea('referans', null, array('placeholder' => 'referans','class' => 'form-control form-control-lg mb-3')) !!}
             </div>

            </div>
            <div class="card-footer border-top">
                <a href="#" id="saveBtn" class="btn btn-sm btn-accent ml-auto d-table mr-3">Kaydet</a>
            </div>
        </div>
        <!-- End Edit User Details Card -->
    </div>

    <!-- End Edit User Details Card -->
</div>

</div>
{!! Form::close() !!} @stop @section('scripts')
<script language="javascript" type="text/javascript">
    $("#saveBtn").click(function() {
        $("#formId").submit();
    });

  
</script>

@endsection