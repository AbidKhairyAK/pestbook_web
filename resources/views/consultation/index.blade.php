@extends('app')

@section('title', 'Konsultasi');

@section('content')
<div class="d-flex justify-content-between align-items-end">
	<span><b>Tabel Daftar Konsultasi</b></span>
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
			<th>Judul Pertanyaan</th>
			<th width="100">Tipe</th>
			<th width="100">Status</th>
			<th width="120">Tgl Tanya</th>
			<th width="80">Opsi</th>
		</tr>
	</thead>
	<tbody>
		@php $no = 1; @endphp
		@foreach($model as $m)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ substr($m->title, 0, 45).(strlen($m->title) > 45 ? '...' : '') }}</td>
			<td>{{ $m->type->name }}</td>
			<td><span class="badge badge-{{ $m->status ? 'info' : 'warning' }}">
				{{ $m->status ? 'Dijawab' : 'Belum' }}
			</span></td>
			<td>{{ substr($m->created_at,0,10) }}</td>
			<td>
				<form method="post" action="{{ route('consultations.destroy', $m->id) }}" class="mb-0">
					@csrf @method('DELETE')
					<a href="{{ route('consultations.edit', $m->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="jawab"><i class="fas fa-fw fa-comment-dots"></i></a>
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