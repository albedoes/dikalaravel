@extends('layout.v_template')

@section('title', 'DETAIL GURU')

@section('content')
<table class="table">
    <tr>
        <th width="150px">NIP</th>
        <th width="30px">:</th>
        <th>{{ $guru->nip }}</th>
    </tr>
    <tr>
        <th width="150px">NAMA GURU</th>
        <th width="30px">:</th>
        <th>{{ $guru->nama_guru }}</th>
    </tr>
    <tr>
        <th width="150px">MATA PELAJARAN</th>
        <th width="30px">:</th>
        <th>{{ $guru->mapel }}</th>
    </tr>
    <tr>
        <th width="150px">FOTO GURU</th>
        <th width="30px">:</th>
        <th><img src="{{ url('foto_guru/'.$guru->foto_guru) }}" width="200px"></th>
    </tr>
    <tr>
        <th><a href="/guru" class="btn btn-success tbn-sm">Kembali</a></th>
    </tr>
</table>
@endsection