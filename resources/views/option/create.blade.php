@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="float-left">
                <h4 class="page-title">Option </h4>
                <small class="text-danger">Periode : {{ periode()->name }}</small>
            </div>
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Management</a></li>
                <li class="breadcrumb-item active"><a href="{{route('option.index')}}">Option</a></li>
                <li class="breadcrumb-item active">Tambah </li>
                </ol>
                <small class="text-danger">Tahun Buku : {{ periode()->open_date }} - {{ periode()->close_date }}</small>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title">FORM TAMBAH OPTION</h4>
            <div class="p-20">
                {!! Form::open(['url' => route('option.store'), 'class' => 'form-horizontal']) !!}
                    @include('option._form')
                {!! Form::close() !!}
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
@endsection
