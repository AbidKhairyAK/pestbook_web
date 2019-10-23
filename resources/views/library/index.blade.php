@extends('app')

@section('title', 'Library HPT');

@section('content')
<div class="d-flex justify-content-between align-items-end">
	<span><b>Tabel Daftar Library HPT</b></span>
	<a href="{{ route('libraries.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
</div>
<hr>

<ul class="nav nav-tabs nav-justified mb-3">
  <li class="nav-item">
    <a class="nav-link {{ is_null($type) ? 'active' : '' }}" href="?type=">Semua Data</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $type == 'hama' ? 'active' : '' }}"href="?type=hama">Hama</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $type == 'penyakit' ? 'active' : '' }}"href="?type=penyakit">Penyakit</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $type == 'abiotik' ? 'active' : '' }}"href="?type=abiotik">Abiotik</a>
  </li>
</ul>

<table class="table table-striped">
	<thead>
		<tr>
			<th width="20">#</th>
			<th>Nama</th>
			<th width="100">Tipe</th>
			<th width="120">Tgl Dibuat</th>
			<th width="120">Tgl Diedit</th>
			<th width="80">Opsi</th>
		</tr>
	</thead>
	<tbody>
		@php $no = 1; @endphp
		@foreach($model as $m)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $m->name }}</td>
			<td>{{ $m->type->name }}</td>
			<td>{{ substr($m->created_at,0,10) }}</td>
			<td>{{ substr($m->updated_at,0,10) }}</td>
			<td>
				<form method="post" action="{{ route('libraries.destroy', $m->id) }}" class="mb-0">
					@csrf @method('DELETE')
					<a href="{{ route('libraries.edit', $m->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="edit"><i class="fas fa-fw fa-edit"></i></a>
					<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="hapus"><i class="fas fa-fw fa-trash"></i></button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready( function () {
		$('[data-toggle="tooltip"]').tooltip();
    	$('.table').DataTable();
	});
</script>
@endsection