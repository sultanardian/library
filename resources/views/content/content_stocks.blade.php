@extends('dashboard')

@section('Stock-active', 'active')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2">Data Stok</h1>
</div>

<div class="row">
	<div class="col-lg-4">
		<h3>Tambah Stok Baru</h3>
		<form action="{{ route('storeStock') }}" method="POST">
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Judul Buku</label>
				<input type="text" class="form-control" id="title" name="title" autocomplete="off">
				<input type="hidden" name="book_id", id='book_id'>
				<div id="title-suggestions" class="dropdown"></div>
			</div>
			<div class="mb-3">
				<label for="stocks" class="form-label">Jumlah Stok</label>
				<input type="number" class="form-control" id="stocks" name="stocks" autocomplete="off">
			</div>
			<button type="submit" class="btn btn-primary">Tambah</button>
		</form>
	</div>

	<div class="col-lg-7 ml-3">

		<div>
			<!-- Displaying book Stock data -->
			<h3>Stok</h3>

			<table class="table">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Judul Buku</th>
						<th>Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					@foreach($books as $book)
					@if($book->stocks > 0)
					<tr>
						<td>{{ $book->book_code }}</td>
						<td>{{ $book->title }}</td>
						<td>{{ $book->stocks }}</td>
						<td>
							<div class="btn-group" role="group">
								<form action="{{ route('deleteStock') }}" method="POST">
									@csrf
									@method('DELETE')
									<input type="hidden" name="book_id" id='book_id' value={{ $book->id }}>
									<button type="submit" style="border: none;" class="mr-2" onclick="return confirm('Are you sure you want to delete this data?')">
										<span data-feather='trash'></span>
									</button>
								</form>

								<button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editStockModal{{$book->id}}">
									<span data-feather='edit'></span>
								</button>
							</div>

							<!-- Modal Edit Stok -->
							<div class="modal fade" id="editStockModal{{$book->id}}" tabindex="-1" aria-labelledby="editStockModalLabel{{$book->id}}" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="editStockModalLabel{{$book->id}}">Ubah Data Stok</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="{{ route('updateStock', $book->id) }}" method="POST">
												@csrf
												@method('PUT')
												<input type="hidden" name="book_id" id='book_id' value="{{ $book->id }}">
												<div class="mb-3">
													<label for="code" class="form-label">Kode</label>
													<input type="text" class="form-control" id="editCode" autocomplete="off" value="{{$book->book_code}}" disabled readonly>
												</div>
												<div class="mb-3">
													<label for="stocks" class="form-label">Jumlah Stok</label>
													<input type="number" class="form-control" id="editStocks" name="stocks" autocomplete="off" value="{{ $book->stocks }}">
												</div>
												
												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const titleSuggestions = {!! $books !!};
    const titleInput = document.getElementById('title');
    const titleHiddenInput = document.getElementById('book_id');
    const suggestionsContainer = document.getElementById('title-suggestions');
    titleInput.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        const filteredSuggestions = search(titleSuggestions, keyword, 'title');
        console.log(filteredSuggestions);
        titles = [];
        // codes = [];
        identifiers = [];
        filteredSuggestions.forEach((item) => {
          // Lakukan operasi yang diinginkan pada setiap item JSON
            titles.push(item.book_code.concat(' - ', item.title));
            // codes.push(item.book_code)
            identifiers.push(item.id);
        });

        suggestionsContainer.innerHTML = '';
        // filteredSuggestions.slice(0, 5).forEach(function(suggestion) {
        titles.slice(0, 5).forEach(function(suggestion) {
            const suggestionElement = document.createElement('div');
            suggestionElement.classList.add('suggestion');
            suggestionElement.innerText = suggestion;
            suggestionElement.addEventListener('click', function() {
                titleInput.value = suggestion;
                const idx = titles.indexOf(suggestion)
                suggestionsContainer.innerHTML = '';
                titleHiddenInput.dispatchEvent(new Event('input'));
                // Set nilai langsung ke value saat saran diklik
                titleHiddenInput.setAttribute('value', identifiers[idx]);
            });
            suggestionsContainer.appendChild(suggestionElement);
        });
    });

    suggestionsContainer.addEventListener('click', function(event) {
        const clickedSuggestion = event.target.innerText;
        titleInput.value = clickedSuggestion;
        suggestionsContainer.innerHTML = '';
        // Set nilai langsung ke value saat saran diklik
        titleHiddenInput.setAttribute('value', identifiers[idx]);
        // titleHiddenInput.value = identifiers[idx];
    });
</script>
@endsection