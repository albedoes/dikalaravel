@extends('layout.v_template')

@section('title', 'GURU')
@section('content')
@if (session('pesan'))
<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> SUCCESS!</h4>
                {{ session('pesan')}}
              </div>
@endif

@if (session('delete'))

<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> DELETE SUCCESS!</h4>
                {{ session('delete')}}
              </div>
@endif

<a href="/guru/add" class="btn btn-sm btn-primary">Tambahkan Data</a> <br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Foto Guru</th>
        </tr>
    </thead>
    <?php $no=1; ?>
    @foreach ($guru as $data)
    <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $data->nip }}</td>
    <td>{{ $data->nama_guru }}</td>
    <td>{{ $data->mapel; }}</td>
    <td><img src="{{ url('foto_guru/'.$data->foto_guru) }}" width="100px"></td>
<td>
    <a href="/guru/detail/{{ $data->id_guru }}" class="btn btn-sm btn-success">Detail</a>
    <a href="/guru/edit/{{ $data->id_guru }}" class="btn btn-sm btn-warning">Edit</a>
    <button type="button" class="btn-sm bg-red-500 hover:bg-red-600 text-white" data-toggle="modal" data-target="#delete{{ $data->id_guru }}">
                DELETE
              </button>
</td>
</tr>
        @endforeach
    </tbody>
</table>
@foreach ($guru as $data)
<div class="modal modal-warning fade" id="delete{{ $data->id_guru }}">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $data->nama_guru }}</h4>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No</button>
                <a href="/guru/delete/{{ $data->id_guru }}" class="btn btn-outline">YES</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</div>

@endforeach
@endsection