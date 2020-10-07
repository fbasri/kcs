@extends('layouts.master')
@section('style')
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Laporan Simpanan</h4>

            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Simpanan</li>
            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <form id="periode" action="{{ route('laporan.simpanan-all') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="">Tanggal Awal</label>
                    <input type="text" class="form-control datepicker" name="start_date" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Akhir</label>
                    <input type="text" class="form-control datepicker" name="end_date" autocomplete="off">
                </div>
                {{-- <input type="submit" value="Cari" class="btn btn-primary" name="search">
                @role('admin')
                <input type="submit" value="Excell" class="btn btn-danger" name="export_excell">
                @endrole --}}
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <form id="anggota-form">
                <table class="table-small-font">
                    <thead>
                        <tr>
                            <th>Nama Anggota :</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $item)
                            <td class="checkbox checkbox-success form-check-inline">
                                <input type="checkbox" id="inlineCheckbox{{$item->id}}" value="{{$item->id}}" name="anggota[]">
                                <label for="inlineCheckbox{{$item->id}}"> {{ $item->nama }} </label>
                            </td>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-success text-right" type="button" id="export">Excell</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script>
    $(function(){
        $(".select2").select2();

        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });

        $('#export').click(function(e){
            var data = $('#anggota-form, #periode').serialize();
            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type: 'POST',
                url: '{{ route('laporan-simpanan-all.export')}}',
                data: data,
                success: function(result, status, xhr)
                {
                    if(data.error){
                        console.log("Jika Error Selain Dari Kosong Ke Error");
                        $.toast({
                            heading: 'Error !',
                            text: data.error,
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                    }else {
                        var disposition = xhr.getResponseHeader('content-disposition');
                        var matches = /"([^"]*)"/.exec(disposition);
                        var filename = (matches != null && matches[1] ? matches[1] : 'salary.xlsx');

                        // The actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;

                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);
                    }
                }
            })
        });
    })
</script>
@endsection
