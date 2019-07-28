@extends('admin.layouts.app')
@section('content')


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
            <h3 class="page-title">Edit New Post</h3>
        </div>
    </div>
    <!-- End Page Header -->

    {!! Form::model($posts, ['method' => 'PATCH','files'=>'true',  'class' => ' add-new-post', "id"=>"formId", 'route' => ['kumbara.update', $posts->id]]) !!}
    <div class="row">

        <div class="col-lg-8 mb-4">
            <!-- Edit User Details Card -->
            <div class="card card-small edit-user-details mb-4">

                <div class="card-body p-0">



                    <hr>

                    <div class="form-row mx-4">
                        <label>Title:</label>
                        {!! Form::text('post_title', null, array('placeholder' => 'Your Post Title','class' => 'form-control form-control-lg mb-3')) !!}
                    </div>

                    <div class="form-row mx-4">
                        <label>Description:</label>
                        @include('admin.partials.tinymce')
                        {!! Form::textarea('post_content', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                    </div>

                    <br>
                    <br>

                    <div class="form-row mx-4">
                        <label>MEdia:</label>
                        <img class="img-thumbnail img-responsive"  src="/uploads/{{$posts->media_picture}}" alt="" class="img-responsive">

                        {!! Form::file('media_picture', null, array('placeholder' => 'MEdia','class' => 'form-control')) !!}
                    </div>

                    <br>
                    <div class="form-row mx-4">
                        <label> Virgül ile ayırarark tag giriniz:</label>
                        {!! Form::text('taqs', $tags, array('placeholder' => 'Your tags','class' => 'form-control form-control-lg mb-3')) !!}
                    </div>

                    @if ($posts->tags()->count() > 0)
                        <ul>

                            <h5>            Taglar  ({{$posts->tags()->count()}})</h5>
                            @foreach ($posts->tags as $tag)
                                <li>
                                    {{$tag->name}}
                                </li>
                            @endforeach
                        </ul>
                    @endif


                    @if ($posts->comments()->count() > 0)
                        <ul>
                            <h5> Yorumlar  ({{$posts->comments()->count()}})</h5>
                            @foreach ($posts->comments as $comments)
                                <li>
                                    {{$comments->comment_content}}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
                <div class="card-footer border-top">
                    <a href="#" class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes</a>
                </div>
            </div>
            <!-- End Edit User Details Card -->
        </div>

        <div class="col-lg-4 mb-4">
            <!-- Edit User Details Card -->

            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                                <span class="d-flex mb-2"><i class="material-icons mr-1">flag</i><strong class="mr-1">Status:</strong> Draft <a
                                        class="ml-auto" href="#">Edit</a></span>
                            <span class="d-flex mb-2"><i class="material-icons mr-1">visibility</i><strong
                                    class="mr-1">Visibility:</strong> <strong
                                    class="text-success">Public</strong>

                                    <a class="ml-auto"
                                       href="#">Edit</a>
                                </span>
                            <span class="d-flex mb-2"><i class="material-icons mr-1">calendar_today</i><strong
                                    class="mr-1">Schedule:</strong> Now

                                  <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="conversationsEmailsToggle" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="conversationsEmailsToggle"></label>
                          </div>

                                </span>
                            <span class="d-flex"><i class="material-icons mr-1">score</i><strong class="mr-1">Readability:</strong> <strong
                                    class="text-warning">Ok</strong></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-outline-accent"><i class="material-icons">save</i>
                                Save
                                Draft
                            </button>
                            <button id="saveBtn" class="btn btn-sm btn-accent ml-auto"><i
                                    class="material-icons">file_copy</i>
                                Publish
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->
            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0">Categories</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-3 pb-2">
                            <h5>            Bağlı olduğu kategoriler ({{$posts->categories()->count()}})</h5>
                            @foreach ($posts->categories as $cat)
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" checked id="category{{$cat->id}}"
                                           value="{{$cat->id}}" name="cat[]">
                                    <label class="custom-control-label"
                                           for="category{{$cat->id}}"> {{$cat->name}}</label>
                                </div>
                            @endforeach
                            @foreach ($otherCat as $key=>$cat)
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="category{{$key}}"
                                           value="{{$key}}" name="cat[]">
                                    <label class="custom-control-label"
                                           for="category{{$key}}"> {{$cat}}</label>
                                </div>
                            @endforeach

                        </li>
                        <li class="list-group-item d-flex px-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="New category"
                                       aria-label="Add new category" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-white px-2" type="button"><i
                                            class="material-icons">add</i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->
        </div>

        <!-- End Edit User Details Card -->
    </div>

    </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    <script language="javascript" type="text/javascript">
        $("#saveBtn").click(function () {
            $("#formId").submit();
        });
    </script>
@endsection
