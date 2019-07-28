@extends('admin.layouts.app')
@section('content')
    <div class="main-content-container container-fluid px-4">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                <span class="text-uppercase page-subtitle">Blog Posts</span>
                <h3 class="page-title"> Post</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">

                        <strong>Title:</strong>

                        {{ $posts->post_title }}

                    </div>

                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">

                        <strong>Description:</strong>

                        {{ $posts->post_content }}

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">

                        <strong>İmage:</strong>
                        <img src="/uploads/{{ $posts->media_picture}}" alt="">

                    </div>

                </div>


            </div>
            @foreach ($tags as  $employee)

                @if ($loop->iteration == 1)
                    <b>: {{ $tags->count() }} tag(s)</b>
                @endif
                {{ $employee->name }},
            @endforeach
        </div>

    </div>
@stop
