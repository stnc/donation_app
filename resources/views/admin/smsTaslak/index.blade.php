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


            @if ($message = Session::get('success'))

                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>

            @endif

        <!-- Page Header -->

        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Mesaj Taslakları listesi</span>
                <h3 class="page-title"> Mesaj Taslakları </h3>
            </div>
        </div>
        <!-- End Page Header -->



            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Mesaj Taslakları</h6>
                        </div>
                        <div class="card-body p-0 pb-3 text-center">
                            <table  id="example1"  class="table mb-0">
                                <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Mesaj</th>
                        
                                    <th width="280px">Olaylar</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @stop
            @push('styles')
                <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
            @endpush

            @push('scripts')

                <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
                <script>


                    $(document).ready(function () {
                        $('#example1').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{ route('posts/getsmstaslaklist').'?tek='.request()->get('tek') }}',
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'mesaj', name: 'mesaj'},
                           
             
                                {data: 'action', name: 'action', orderable: false, searchable: false}
                            ],
                            "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                            initComplete: function () {
                                this.api().columns().every(function () {
                                    var column = this;
                                    $(column.header()).append("<br>")
                                    var select = $('<select><option value=""></option></select>')
                                        .appendTo($(column.header()))
                                        .on('change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );

                                            column
                                                .search(val ? ' ' + val + ' ' : '', true, false)
                                                .draw();
                                        });
                                    column.data().unique().sort().each(function (d, j) {
                                        select.append('<option value="' + d + '">' + d + '</option>')
                                    });
                                });
                            },

                            columnDefs: [{orderable: false, targets: [-1]}],


                        });
                    });
                </script>
    @endpush

