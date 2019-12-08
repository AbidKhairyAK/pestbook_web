@extends('app')

@php $e = isset($model); @endphp

@section('title', 'Library HPT')

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css"/>
<style type="text/css">
	.CodeMirror, .CodeMirror-scroll{
		min-height: 200px;
		max-height: 200px;
	}
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-end">
	<span><b>Form Library HPT</b></span>
	<a href="{{ route('libraries.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
</div>
<hr>

<form action="{{ $route }}" method="post" enctype="multipart/form-data" id="form">
	@csrf
	{{ $e ? method_field('PUT') : '' }}

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Tipe:</label>
				<select class="form-control" name="type_id" required>
					@foreach($type as $i => $t)
					<option {{ $e && $model->type_id == $i ? 'selected' : '' }} value="{{ $i }}">{{ $t }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<h6><b>Versi Indonesia</b></h6>
			<div class="form-group">
				<label>Nama:</label>
				<input type="text" class="form-control" name="name" value="{{ $e ? $model->name : '' }}" required>
			</div>
			<div class="form-group">
				<label>Deskripsi:</label>
				<textarea rows="4" class="form-control" name="description">{{ $e ? $model->description : '' }}</textarea>
			</div>
			<div class="form-group">
				<label>Gejala:</label>
				<textarea rows="4" class="form-control" name="indication">{{ $e ? $model->indication : '' }}</textarea>
			</div>
			<div class="form-group">
				<label>Pengendalian:</label>
				<textarea rows="4" class="form-control" name="control">{{ $e ? $model->control : '' }}</textarea>
			</div>
		</div>

		<div class="col-md-6">
			<h6><b>Versi Inggris</b> <sup class="text-muted">(opsional)</sup></h6>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="name_en" value="{{ $e ? $model->name_en : '' }}" required>
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea rows="4" class="form-control" name="description_en">{{ $e ? $model->description_en : '' }}</textarea>
			</div>
			<div class="form-group">
				<label>Indication:</label>
				<textarea rows="4" class="form-control" name="indication_en">{{ $e ? $model->indication_en : '' }}</textarea>
			</div>
			<div class="form-group">
				<label>Control:</label>
				<textarea rows="4" class="form-control" name="control_en">{{ $e ? $model->control_en : '' }}</textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="mr-5">Gambar:</label>

					@if($e)
					<div class="my-3">
						<input type="hidden" name="deleted_image">
						<p><small><b>Gambar Tersimpan:</b></small></p>
						@foreach($model->images()->get() as $i => $image)
						<div id="stored{{ $i+1 }}" class="mr-2" style="width: 200px; display: inline-block;">
							<div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;display: inline-block; overflow: hidden;">
						    <img src="{{ '/img/library/'.$image->thumbnail }}"  alt="..." style="width: 100%;">
						  </div>
						  <button onclick="delete_image({{ $i+1 }}, {{ $image->id }})" type="button" class="mt-2 btn btn-sm btn-block btn-outline-secondary">x</button>
						</div>
					  @endforeach
						<p class="mt-3"><small><b>Gambar Baru:</b></small></p>
					</div>
				  @endif

				<div class="form-wrapper d-flex align-items-start">

					<button id="new-image" type="button" class="btn btn-outline-secondary mr-2" title="tambah gambar" style="height: 150px;"><i class="fas fa-plus"></i></button>

					<div id="images-wrapper">

						<div id="item1" class="fileinput fileinput-new mr-2" data-provides="fileinput">
						  <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
						    <img src="https://via.placeholder.com/200x150?text=Pilih+Gambar"  alt="...">
						  </div>
						  <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
						  <div>
						    <span class="btn btn-outline-secondary remove-image" id="remove1"><b>x</b></span>
						    <span class="btn btn-outline-secondary btn-file">
						    	<span class="fileinput-new">Select image</span>
						    	<span class="fileinput-exists">Change</span>
						    	<input type="file" name="images[]">
						    </span>
						    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
						  </div>
						</div>

					</div>

				</div>
			</div>

			<br>
			<button type="submit" class="btn btn-success btn-block btn-lg mt-3 float-right"><b>Submit</b></button>
		</div>
	</div>
</form>

@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		var description_mde = new SimpleMDE({ element: $("textarea[name=description]")[0], spellChecker: false });
		var indication_mde = new SimpleMDE({ element: $("textarea[name=indication]")[0], spellChecker: false });
		var control_mde = new SimpleMDE({ element: $("textarea[name=control]")[0], spellChecker: false });

		var description_en_mde = new SimpleMDE({ element: $("textarea[name=description_en]")[0], spellChecker: false });
		var indication_en_mde = new SimpleMDE({ element: $("textarea[name=indication_en]")[0], spellChecker: false });
		var control_en_mde = new SimpleMDE({ element: $("textarea[name=control_en]")[0], spellChecker: false });

		@if($e)
			description_mde.value(`{{ $model->description }}`);
			indication_mde.value(`{{ $model->indication }}`);
			control_mde.value(`{{ $model->control }}`);

			description_en_mde.value(`{{ $model->description_en }}`);
			indication_en_mde.value(`{{ $model->indication_en }}`);
			control_en_mde.value(`{{ $model->control_en }}`);
		@endif

		$('#form').submit(function(e) {
			if (description_mde.value() == '' || indication_mde.value() == '' || control_mde.value() == '') {
				alert('Kolom Deskripsi, Gejala, dan Pengendalian tidak boleh kosong!');
				e.preventDefault();
			}
		})

		$('#new-image').click(function() {
			var current = parseInt($('.fileinput:first-child').attr('id').replace('item', ''));

			$('#images-wrapper').prepend(`
				<div id="item${current+1}" class="fileinput fileinput-new mr-2" data-provides="fileinput">
				  <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
				    <img src="https://via.placeholder.com/200x150?text=Pilih+Gambar"  alt="...">
				  </div>
				  <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				  <div>
				    <span class="btn btn-outline-secondary remove-image" id="remove${current+1}"><b>x</b></span>
				    <span class="btn btn-outline-secondary btn-file">
				    	<span class="fileinput-new">Select image</span>
				    	<span class="fileinput-exists">Change</span>
				    	<input type="file" name="images[]">
				    </span>
				    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
				  </div>
				</div>
			`);

			$('.remove-image').click(function() {
				var id = $(this).attr('id').replace('remove', '');
				$('#item'+id).remove();
			});
		});

	});

	function delete_image(index, id) {
		$('#stored'+index).remove();
		var del = $('input[name=deleted_image]');

		del.val( del.val() + ',' + id );
	}
</script>
@endsection