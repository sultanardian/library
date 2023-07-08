@extends('dashboard')

@section('member-active', 'active')

@section('dashboard-content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Siswa</h1>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMemberModal">Siswa Baru</button>
        </div>
    </div>
    <!-- Tabel -->
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data diisi dengan PHP atau data statis -->
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->gender }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('deleteStudent', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none;" class="mr-2">
                              <span data-feather='trash'></span>
                            </button>
                        </form>

                        <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editMemberModal{{$student->id}}" class="mr-2">
                            <span data-feather='edit'></span>
                        </button>

                        <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#showMemberModal{{$student->id}}">
                            <span data-feather='eye'></span>
                        </button>
                    </div>
                    <!-- Modal Edit Siswa -->
                    <div class="modal fade" id="editMemberModal{{$student->id}}" tabindex="-1" aria-labelledby="editMemberModalLabel{{$student->id}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editMemberModalLabel{{$student->id}}">Ubah Data Siswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('updateVisit', $student->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="student" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="student" autocomplete="off" value="{{$student->name}}" disabled readonly>
                                    <div id="student-suggestions" class="dropdown"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="explanation" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="explanation" name="explanation">{{$student->explanation}}</textarea>
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

    <!-- Modal Siswa Baru -->
    <div class="modal fade" id="newMemberModal" tabindex="-1" aria-labelledby="newMemberModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="newMemberModalLabel">Tambah Data Siswa</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
			<form action="{{ route('storeStudent') }}" method="POST">
	            @csrf
                <div class="mb-3">
                    <label for="identifier" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="identifier" name="identifier" autocomplete="off">
                </div>
	            <div class="mb-3">
	                <label for="name" class="form-label">Nama Siswa</label>
	                <input type="text" class="form-control" id="name" name="name" autocomplete="off">
	            </div>
                <label for="form-check" class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="L" checked>
                    <label class="form-check-label" for="gender1">
                    Laki Laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="P">
                    <label class="form-check-label" for="gender2">
                    Perempuan
                    </label>
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="class" name="class" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="place_birth" class="form-label">Tempat lahir</label>
                    <input type="text" class="form-control" id="place_birth" name="place_birth" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="date_birth" class="form-label">Tanggal lahir</label>
                    <div class="form-row">
                        <div class="col">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="int" class="form-control" id="date" name="date" autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="month" class="form-label">Bulan</label>
                            <input type="int" class="form-control" id="month" name="month" autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="year" class="form-label">Tahun</label>
                            <input type="int" class="form-control" id="year" name="year" autocomplete="off">
                        </div>
                    </div>
                    <!-- <input type="text" class="form-control" id="date_birth" name="date_birth" autocomplete="off"> -->
                </div>
	            <div class="mb-3">
	                <label for="address" class="form-label">Alamat</label>
	                <textarea class="form-control" id="address" name="address"></textarea>
	            </div>
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#date_birth').date_birth({
      format: 'yyyy-mm-dd', // Format tanggal yang diinginkan
      autoclose: true // Menutup datepicker setelah memilih tanggal
    });
  });
</script>
@endsection