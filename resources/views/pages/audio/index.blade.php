@extends('layouts.app')
@section('title', 'Audio')
@section('styles')

@endsection

@section('content')

    @section('content')

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Audios</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Audios</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Audios DataTable</h3>
                    </div>
                    <div class="card-body">
                        {{--                                                @can("write status")--}}
                        <button class="btn btn-success-gradient mb-4 data-table-btn" id="add-audio">
                            Add Audio
                        </button>
                        {{--                                                @endcan--}}
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="audio-datatable">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    @endsection

@endsection

@section('modal')
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Are you sure you want to delete this Audio ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">Add Audio</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/rainbow.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>
    <script src="{{asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{asset('assets/js/table-data.js')}}"></script>




    <script>
        var table = $('#audio-datatable').DataTable({
                dom: 'Bfrtip',
                processing: false,
                serverSide: true,
                buttons: [
                    {
                        text: 'Reload',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                    {'extend': 'pageLength'},
                ],

                ajax: {
                    url: "{{route('audio.datatables')}}"
                },
                columns: [
                    {title: 'ID', data: 'id',className: 'text-center'},
                    {title: 'Category', data: 'categoryName',className: 'text-center'},
                    {title: 'Title', data: 'title',className: 'text-center'},
                    {title: 'Title AR', data: 'title_ar',className: 'text-center'},
                    {
                        title: 'Status',
                    className: 'text-center',
                        data: 'status',

                        render: function (data) {
                            if (data == 1)
                                return '<span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Active</span>';
                            else
                                return '<span class="badge font-weight-semibold bg-secondary-transparent text-secondary tx-11">InActive</span>';
                        }
                    },
                    {
                        title: 'Audio',
                        data: 'path',
                    className: 'text-center',
                        render: function (data) {
                            if (data) {
                                return ` <audio controls>
                <source src="${data}" type="audio/ogg">
                <source src="${data}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>`;
                            } else {
                                return '';
                            }
                        }
                    },
                    {title: 'Created At', data: 'created_at',className: 'text-center'},
                    {
                        data: 'id',
                        title: 'Actions',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            return `
        <button class="btn show-btn" data-id="${data}" title="Show">
            <i class="fa fa-eye fa-lg custom-Action-show" aria-hidden="true"></i>
            <span class="sr-only">Show</span>
        </button>


        <button class="btn edit-btn" data-id="${data}" title="Edit">
            <i class="fa fa-edit fa-lg text-success" aria-hidden="true"></i>
            <span class="sr-only">Edit</span>
        </button>

        <button class="btn delete-btn" data-id="${data}" title="Delete">
            <i class="fa fa-lg fa-trash custom-Action-delete" aria-hidden="true"></i>
            <span class="sr-only">Delete</span>
        </button>
    `;
                        }
                    }
                ]
            })
        ;

        $('#add-audio').on('click', function (e) {
            e.preventDefault();
            $('#modal-add-audio').modal('show');
        })

        $('#audio-datatable').on('click', '.edit-btn', function () {
            let id = $(this).data('id');

            var baseUrl = "{{ route('audio.show', '') }}";
            $.ajax({
                url: baseUrl + "/" + id,
                type: 'GET',
                success: function (data) {
                    $('#modal .modal-body').html(data);
                    $('#modal .modal-title').html('Edit Audio');
                    $('#modal').modal('show');
                },
                error: function (error) {
                    $.growl.error({title: "Error", message: 'Something Went Wrong!'});
                }
            });
        });

        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#confirmDelete').attr('delete-id', id);
            $("#confirmationModal").modal('show');
        });

        $(document).on('click', '#confirmDelete', function () {
            var baseUrl = "{{ route('audio.destroy', '') }}";
            let id = $(this).attr('delete-id');
            $.ajax({
                url: baseUrl + "/" + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status === 'success') {
                        table.ajax.reload();
                        $.growl.notice({title: "Success", message: data.message});
                        $("#confirmationModal").modal('hide');
                    }
                },
                error: function (error) {
                    $.growl.error({title: "Error", message: "Something went wrong!"});
                    $("#confirmationModal").modal('hide');
                }
            });
        });


        $('#add-audio').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('audio.create')}}",
                success: function (data) {
                    $('#modal .modal-body').html(data);
                    $('#modal').modal('show');
                }
            })
        })


        $('#audio-datatable').on('click', '.show-btn', function () {
            let id = $(this).data('id');

            var baseUrl = "{{ route('audio.show', '') }}";
            $.ajax({
                url: baseUrl + "/" + id,
                type: 'GET',
                data: {
                    'show': 1
                },
                success: function (data) {
                    $('#modal .modal-body').html(data);
                    $('#modal .modal-title').html('Show Audio');
                    $('#modal').modal('show');
                },
                error: function (error) {
                    $.growl.error({title: "Error", message: 'Something Went Wrong!'});
                }
            });
        });

    </script>

@endsection
