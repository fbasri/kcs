@extends('layouts.master')
@section('style')
<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Copy Saldo</h4>

            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Management Copy Saldo</a></li>
                <li class="breadcrumb-item active">Copy Saldo</li>
            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->
@if (session()->has('flash_notification.message'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    </div>
</div>
@endif
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <table id="role" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>From Periode</th>
                        <th>To Periode</th>
                        <th>Divisi</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- Required datatable js -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var oTable = $('#role').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('copy-saldo.index') }}",
                        columns: [
                            { data: 'from_periode.name', name: 'from_periode.name' },
                            { data: 'to_periode.name', name: 'to_periode.name' },
                            { data: 'divisi.name', name: 'divisi.name' },
                            { data: 'status_saldo', name: 'status_saldo' },
                            { data: 'action', name: 'action', searchable: false, orderable: false }
                        ],
                        order: [[ 0, "desc" ]],
                        dom: '<"toolbar">frtip',
                    });
        @permission('create-copy-saldo')
        $("div.toolbar").html(`<a href="{{ route('copy-saldo.create') }}" class="btn btn-gradient btn-rounded waves-light waves-effect w-md">Tambah Copy Saldo</a>`);
        @endpermission

    });
</script>
@endsection
