@extends('dashboard')

@section('category-active', 'active')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pinjaman</h1>
</div>

<div class="row">
    <div class="col-lg-4">
        <h3>Tambah Pinjaman Baru</h3>
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="book_title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="book_title" name="book_title" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Kode</label>
                <input type="text" class="form-control" id="code" name="code" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="student" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="student" name="student" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="identifier" class="form-label">NIS</label>
                <input type="text" class="form-control" id="identifier" name="identifier" autocomplete="off">
            </div>

<!-- <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
        <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
    </div>
</div> -->
            


            <div class="mb-3">
                <label for="return_date" class="form-label">Tanggal Kembali</label>
                <!-- <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker"/>
                <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                </div> -->
                <input type="text" class="form-control" id="datepicker" name="return_date" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <div class="col-lg-7 ml-3">

        <div>
            <!-- Displaying book category data -->
            <h3>Pinjaman</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pinjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border: none;" class="mr-2" onclick="return confirm('Are you sure you want to delete this data?')">
                                        <span data-feather='trash'></span>
                                    </button>
                                </form>

                                <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editCategoryModal---">
                                    <span data-feather='edit'></span>
                                </button>
                            </div>

                            <!-- Modal Edit Pinjaman -->
                            <div class="modal fade" id="editCategoryModal---" tabindex="-1" aria-labelledby="editCategoryModalLabel---" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editCategoryModalLabel---">Ubah Data Pinjaman</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="code" class="form-label">Kode</label>
                                                    <input type="text" class="form-control" id="code" autocomplete="off" value="---" disabled readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Pinjaman</label>
                                                    <input type="text" class="form-control" id="category" autocomplete="off" name="category" value="---">
                                                </div>


                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  $('#datepicker').datetimepicker({
    format: 'YYYY-MM-DD', // Format tanggal yang diinginkan
    icons: {
      time: 'fa fa-clock',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-calendar-check-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    }
  });
});
// $(document).ready(function() {
//   $('#date-picker').datetimepicker({
//     format: 'YYYY-MM-DD',
//   });
// });
</script>
@endsection