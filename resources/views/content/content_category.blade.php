@extends('dashboard')

@section('category-active', 'active')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2">Data Kategori</h1>
</div>

<div class="row">
	<div class="col-lg-4">
		<h3>Tambah Kategori Baru</h3>
		<form action="{{ route('storeCategory') }}" method="POST">
			@csrf
			<div class="mb-3">
				<label for="code" class="form-label">Kode</label>
				<input type="text" class="form-control" id="code" name="code" autocomplete="off">
			</div>
			<div class="mb-3">
				<label for="category" class="form-label">Kategori</label>
				<input type="text" class="form-control" id="category" name="category" autocomplete="off">
			</div>
			<button type="submit" class="btn btn-primary">Tambah</button>
		</form>
	</div>

	<div class="col-lg-7 ml-3">

		<div>
			<!-- Displaying book category data -->
			<h3>Kategori</h3>

			<table class="table">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					@foreach($categories as $category)
					<tr>
						<td>{{ $category->code }}</td>
						<td>{{ $category->category }}</td>
						<td>
							<div class="btn-group" role="group">
								<form action="{{ route('deleteCategory', $category->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" style="border: none;" class="mr-2" onclick="return confirm('Are you sure you want to delete this data?')">
										<span data-feather='trash'></span>
									</button>
								</form>

								<button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}">
									<span data-feather='edit'></span>
								</button>
							</div>

							<!-- Modal Edit Kategori -->
							<div class="modal fade" id="editCategoryModal{{$category->id}}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{$category->id}}" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="editCategoryModalLabel{{$category->id}}">Ubah Data Kategori</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="{{ route('updateCategory', $category->id) }}" method="POST">
												@csrf
												@method('PUT')
												<div class="mb-3">
													<label for="code" class="form-label">Kode</label>
													<input type="text" class="form-control" id="code" autocomplete="off" value="{{$category->code}}" disabled readonly>
												</div>

												<div class="mb-3">
													<label for="category" class="form-label">Kategori</label>
													<input type="text" class="form-control" id="category" autocomplete="off" name="category" value="{{$category->category}}">
												</div>


												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
@endsection