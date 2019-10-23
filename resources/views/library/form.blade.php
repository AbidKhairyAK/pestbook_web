@extends('app')

@section('title', 'Library HPT');

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-end">
	<span><b>Tambah Data Library HPT</b></span>
	<a href="{{ route('libraries.create') }}" class="btn btn-sm btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
</div>
<hr>

<div class="row">
	<div class="col-md-8">
		<form action="{{ $route }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label>Nama:</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label>Tipe:</label>
				<select class="form-control" name="type_id">
					@foreach($type as $i => $t)
					<option value="{{ $i }}">{{ $t }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Deskripsi:</label>
				<textarea rows="4" class="form-control" name="description"></textarea>
			</div>
			<div class="form-group">
				<label>Gejala:</label>
				<textarea rows="4" class="form-control" name="indication"></textarea>
			</div>
			<div class="form-group">
				<label>Pengendalian:</label>
				<textarea rows="4" class="form-control" name="control"></textarea>
			</div>
			<div class="form-group">
				<label class="mr-5">Gambar:</label>

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
		</form>
	</div>
</div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

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
</script>
@endsection