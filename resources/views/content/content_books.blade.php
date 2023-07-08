@extends('dashboard')

@section('books-active', 'active')

@section('dashboard-content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Buku</h1>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newBookModal">Data Buku Baru</button>
        </div>
    </div>
    <!-- Headbar -->
<!--     <div class="headbar">
        <div class="row">
            <div class="col-md-6">
                <h3>Data Buku</h3>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newBookModal">Data Buku Baru</button>
            </div>
        </div>
    </div> -->

    <!-- Tabel -->
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data diisi dengan PHP atau data statis -->
            @foreach($books as $book)
            <tr>
                <td>{{$book->book_code}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->year}}</td>
                <td>{{$book->stocks}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('deleteBook', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none;" class="mr-2" onclick="return confirm('Are you sure you want to delete this data?')">
                              <span data-feather='trash'></span>
                            </button>
                        </form>

                        <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editVisitModal{{0}}">
                            <span data-feather='edit'></span>
                        </button>
                    </div>

                    <!-- Modal Edit Buku -->
                    <div class="modal fade" id="editVisitModal{{0}}" tabindex="-1" aria-labelledby="editVisitModalLabel{{0}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editVisitModalLabel{{0}}">Ubah Data Buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('updateBook', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="book_code" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="book_code" name="book_code" value="{{ $book->book_code }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input type="text" class="form-control" id="year" name="year" value="{{ $book->year }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="publisher" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="class_code" class="form-label">Kode Kelas</label>
                                    <input type="text" class="form-control" id="class_code" name="class_code" value="{{ $book->class_code }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="shelf_position" class="form-label">Posisi Rak</label>
                                    <input type="text" class="form-control" id="shelf_position" name="shelf_position" value="{{ $book->shelf_position }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="book_origin" class="form-label">Asal Buku</label>
                                    <input type="text" class="form-control" id="book_origin" name="book_origin" value="{{ $book->book_origin }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-control" id="category" name='category_id'>
                                        @foreach($categories as $category)
                                            @if($category->id == $book->category['id'])
                                                <option value="{{ $category->id }}" selected='selected'>
                                                    {{ $category->category }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
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

    <!-- Modal Buku Baru -->
    <div class="modal fade" id="newBookModal" tabindex="-1" aria-labelledby="newBookModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newBookModalLabel">Tambah Data Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form action="{{ route('storeBook') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="book_code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="book_code" name="book_code" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="text" class="form-control" id="year" name="year" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="author" name="author" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="class_code" class="form-label">Kode Kelas</label>
                    <input type="text" class="form-control" id="class_code" name="class_code" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="shelf_position" class="form-label">Posisi Rak</label>
                    <input type="text" class="form-control" id="shelf_position" name="shelf_position" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="book_origin" class="form-label">Asal Buku</label>
                    <input type="text" class="form-control" id="book_origin" name="book_origin" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-control" id="category" name='category_id'>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection