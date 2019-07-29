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
        <span class="text-uppercase page-subtitle">Kumbara</span>
        <h3 class="page-title">Kumbara Düzenle</h3>
    </div>
</div>
<!-- End Page Header -->
{!! Form::model($posts, ['method' => 'PATCH','files'=>'true', 'class' => ' add-new-post', "id"=>"formId", 'route' => ['kumbara.update', $posts->id]]) !!}

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
                    <label>Referans:</label>
                    {!! Form::text('referans', null, array('placeholder' => 'Referans','class' => 'form-control form-control-lg mb-3')) !!}
                </div>

                <div class="form-row mx-4">
                    <label>Miktar:</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">TL</span>
                        </div>
                        {!! Form::text('miktar', null, array('placeholder' => 'miktar','class' => 'form-control')) !!}
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
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

                <hr>

                <div class="form-row mx-4">
                    <label>Meslek:</label>
                    {!! Form::text('meslek', null, array('placeholder' => 'meslek','class' => 'form-control form-control-lg mb-3')) !!}
                </div>
                <div class="form-row mx-4">
                    <label>Email:</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        {!! Form::text('email', null, array('placeholder' => 'email','class' => 'form-control ')) !!}

                    </div>

                </div>

                <div class="form-row mx-4">
                    <label>Açıklama:</label>

                    {!! Form::textarea('aciklama', null, array('placeholder' => 'Açıklama','class' => 'form-control','style'=>'height:100px')) !!}
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-row mx-4">
                            <div class="form-group">
                                <label for="title">İl</label>
                                <select id="city" name="city_id" class="form-control" style="width:350px">
                                    <option value="" selected disabled>Şehir</option>
                                    @foreach($citys as $key => $city)
                                         @if ($posts->city_id == $city->CityID )
                                         <option selected value="{{ $city->CityID }}">{{ $city->CityName }}</option>
                                        @else
                                        <<option value="{{ $city->CityID }}">{{ $city->CityName }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">

                        <div class="form-row mx-4">
                            <div class="form-group">
                                <label for="title">İlçe</label>
                                <select name="town_id" id="town_id" class="form-control" style="width:350px">
                                     @foreach($townList as $key => $town)

                                        @if ($posts->town_id == $town->TownID )
                                          <option selected value="{{ $town->TownID }}">{{ $town->TownName }}</option>
                                        @else
                                        <option value="{{ $town->TownID }}">{{ $town->TownName }}</option>
                                        @endif


                                 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

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

    $('#city').change(function() {
        var cityID = $(this).val();
        if (cityID) {
            $.ajax({
                type: "GET",
                url: "{{url('admin/get-state-list')}}?city_id=" + cityID,
                success: function(res) {
                    if (res) {
                        $("#town_id").empty();
                        $("#town_id").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#town_id").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#town_id").empty();
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