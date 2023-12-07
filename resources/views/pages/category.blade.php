@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    @section('content')

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Categories</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Categories DataTable</h3>
                    </div>
                    <div class="card-body">
                        {{--                                                @can("write status")--}}
                        <button class="btn btn-success-gradient-custom mb-4 data-table-btn" id="add-category">
                            Add Category</button>
                        {{--                                                @endcan--}}
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="category-datatable">
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
    <div class="modal fade " id="modal-add-category" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">Add Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="pic" id="imageUpload" accept="image/*" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(https://s3.me-south-1.amazonaws.com/sightsense/default.png);">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-modal-success-custom" id="add-new-category">Add</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- INPUT MASK JS-->
{{--    <script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>--}}
    <!--Internal  jquery.maskedinput js -->
{{--    <script src="{{asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>--}}

    <!-- SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- DATA TABLE JS-->
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
    <script src="{{asset('assets/js/table-data.js')}}"></script>



    <script>

        var table = $('#category-datatable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            buttons: [
                {
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        dt.ajax.reload();
                    }
                },
                {'extend': 'excel'},
                {'extend': 'print'},
                {'extend': 'pdf'},
                {'extend': 'pageLength'},
            ],

            ajax: {
                url: "{{route('categories.datatables')}}"
            },
            columns: [
                {title: 'ID', data: 'id'},
                {title: 'Name', data: 'name'},
                {title: 'Name AR', data: 'name_ar'},
                {
                    title: 'Status',
                    data: 'status',
                    render: function (data) {
                        if (data == 1)
                            return '<span class="status-indicator projects completed">Active</span>';
                        else
                            return '<span class="status-indicator projects closed">DisActive</span>';
                    }
                },
                {
                    title: 'Image',
                    data: 'image',
                    render: function (data) {
                        if (data) {
                            return `<img src="${data}" alt="Image" class="img-fluid" style="max-height: 50px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"/>`;
                        } else {
                            return '';
                        }
                    }
                },
                {title: 'Created At', data: 'created_at'},
                {
                    data: 'id',
                    title: 'Actions',
                    className: 'text-center',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
        <button class="btn show-btn" data-id="${data}" title="Show">
            <i class="fa fa-eye fa-lg text-dark" aria-hidden="true"></i>
            <span class="sr-only">Show</span>
        </button>

        <button class="btn show-info-btn" data-id="${data}" title="Show Details">
            <i class="icon icon-action-undo fa-lg text-dark" aria-hidden="true"></i>
            <span class="sr-only">Show Details</span>
        </button>

        <button class="btn edit-btn" data-id="${data}" title="Edit">
            <i class="fa fa-edit fa-lg text-success" aria-hidden="true"></i>
            <span class="sr-only">Edit</span>
        </button>

        <button class="btn delete-btn" data-id="${data}" title="Delete">
            <i class="fa fa-lg fa-trash text-danger" aria-hidden="true"></i>
            <span class="sr-only">Delete</span>
        </button>
    `;
                    }
                }

                // {title: 'Description', data: 'description'},
                // {title: 'Description', data: 'description'},
                {{--{--}}
                {{--    title: 'Created By',--}}
                {{--    data: 'created_by',--}}
                {{--    render: function (data, type, row) {--}}
                {{--        if (row['created_by'] && row['created_by'].name) {--}}
                {{--            return row['created_by'].name;--}}
                {{--        }--}}
                {{--        return '';--}}
                {{--    }--}}
                {{--},--}}
                {{--{data: 'created_at', title: 'Created At'},--}}
                {{--{--}}
                {{--    title: 'Image',--}}
                {{--    data: 'image',--}}
                {{--    render: function(data, type, row) {--}}
                {{--        return `<img src="${data}" alt="Image of ${row.name}" class="img-fluid" style="max-height: 50px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"/>`; // Modify '/path/to/images/' to the actual path where your images are stored--}}
                {{--    }--}}
                {{--},--}}
                {{--{--}}
                {{--    data: 'id',--}}
                {{--    title: 'Actions',--}}
                {{--    className: 'text-center',--}}
                {{--    orderable: false,--}}
                {{--    render: function (data, type, row) {--}}
                {{--        return `@can("write status")--}}
                {{--        <button class="btn edit-btn" data-id="${data}"><i class="fal fa-edit fa-lg text-success" data-toggle="tooltip" title="Edit"></i></button>--}}
                {{--       @if(auth()->user()->is_super)  <button class="btn delete-btn" data-id="${data}"><i class="fal fa-lg text-danger fa-trash-alt" data-toggle="tooltip" title="Delete"></i></button> @endif--}}
                {{--        @endcan--}}
                {{--        `;--}}
                {{--    }--}}
                {{--}--}}
            ]
        });

        $('#add-category').on('click', function (e) {
            // e.preventDefault();
            $('#modal-add-category').modal('show');
            {{--$.ajax({--}}
            {{--    url: "{{route($pluralTitle.'.create')}}",--}}
            {{--    success: function (data) {--}}
            {{--        $('#modal .modal-body').html(data);--}}
            {{--        $('#modal').modal('show');--}}
            {{--    }--}}
            {{--})--}}
        })

        {{--$('#{{$pluralTitle}}-datatable').on('click', '.edit-btn', function() {--}}
        {{--    let id = $(this).data('id');--}}

        {{--    var baseUrl = "{{ route($pluralTitle.'.show', '') }}";--}}
        {{--    $.ajax({--}}
        {{--        url: baseUrl + "/" + id,--}}
        {{--        type: 'GET',--}}
        {{--        success: function(data) {--}}
        {{--            $('#modal .modal-body').html(data);--}}
        {{--            $('#modal .modal-title').html('Edit {{$title}}');--}}
        {{--            $('#modal').modal('show');--}}
        {{--        },--}}
        {{--        error: function(error) {--}}
        {{--            $.growl.error({ title: "Error", message: 'Something Went Wrong!' });--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        // $(document).on('click', '.delete-btn', function(e) {
        //     e.preventDefault();
        //     let id = $(this).data('id');
        //     $('#confirmDelete').data('delete-id', id);
        //     $("#confirmationModal").modal('show');
        // });

        {{--$(document).on('click', '#confirmDelete', function() {--}}
        {{--    var baseUrl = "{{ route($pluralTitle.'.destroy', '') }}";--}}
        {{--    let id = $(this).data('delete-id');--}}

        {{--    $.ajax({--}}
        {{--        url: baseUrl + "/" + id,--}}
        {{--        type: 'DELETE',--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success: function(data) {--}}
        {{--            if(data.status === 'success'){--}}
        {{--                table.ajax.reload();--}}
        {{--                $.growl.notice({ title: "Success", message: data.message });--}}
        {{--                $("#confirmationModal").modal('hide');--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function(error) {--}}
        {{--            $.growl.error({ title: "Error", message: "Something went wrong!" });--}}
        {{--            $("#confirmationModal").modal('hide');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}


    </script>

@endsection
