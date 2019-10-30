@extends('app')

@section('title', 'Konsultasi');

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css"/>
<style type="text/css">
	.CodeMirror{
		height: 100px;
	}
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-end">
	<span><b>Jawab Konsultasi</b></span>
	<a href="{{ route('consultations.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
</div>
<hr>

<div class="row">
	<div class="col-md-8">
		<form action="{{ $route }}" method="post" id="form">
			@csrf @method('PUT')
			<div class="form-group">
				<label><b>Judul Pertanyaan:</b></label>
				<div class="border p-2 rounded">{{ $model->title }}</div>
			</div>
			<div class="form-group">
				<label><b>Tipe:</b></label>
				<div class="border p-2 rounded">{{ $model->type->name }}</div>
			</div>
			<div class="form-group">
				<label><b>Gejala yang nampak:</b></label>
				<div class="border p-2 rounded indication"></div>
			</div>
			<div class="form-group">
				<label><b>Gambar:</b></label>
				<br>
				<a href="/img/consultation/{{ $model->image }}" target="_blank" class="border p-2 rounded d-inline-block">
					<img src="/img/consultation/{{ $model->image }}" alt="gambar konsultasi" style="width: 100px;">
				</a>
			</div>
			<div class="form-group">
				<label><b>Jawaban:</b></label>
				<textarea name="answer" id="answer"></textarea>
			</div>

			<br>
			<button type="submit" class="btn btn-success btn-block btn-lg mt-3 float-right"><b>Submit</b></button>
		</form>
	</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var converter = new showdown.Converter(),
		    text      = `{{ $model->indication }}`,
		    html      = converter.makeHtml(text);
		$('.indication').html(html);

		var simplemde = new SimpleMDE({ element: $("#answer")[0], spellChecker: false });

		@if($model->status)
			simplemde.value(`{{ $model->answer }}`);
		@endif

		$('#form').submit(function(e) {
			if (simplemde.value() == '') {
				alert('Kolom jawaban tidak boleh kosong!');
				e.preventDefault();
			}
		})
	});
</script>
@endsection