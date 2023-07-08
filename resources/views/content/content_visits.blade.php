@extends('dashboard')

@section('visits-active', 'active')

@section('dashboard-content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Kunjungan</h1>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newVisitModal">Kunjungan Baru</button>
        </div>
    </div>
    <!-- Tabel -->
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Waktu Kunjungan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data diisi dengan PHP atau data statis -->
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->name }}</td>
                <td>{{ $visit->class }}</td>
                <td>{{ $visit->visit_datetime }}</td>
                <td>{{ $visit->explanation }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('deleteVisit', $visit->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none;" class="mr-2">
                              <span data-feather='trash'></span>
                            </button>
                        </form>

                        <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#editVisitModal{{$visit->id}}">
                            <span data-feather='edit'></span>
                        </button>
                    </div>
                    <!-- Modal Edit Kunjungan -->
                    <div class="modal fade" id="editVisitModal{{$visit->id}}" tabindex="-1" aria-labelledby="editVisitModalLabel{{$visit->id}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editVisitModalLabel{{$visit->id}}">Ubah Data Kunjungan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('updateVisit', $visit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="student" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="student" autocomplete="off" value="{{$visit->name}}" disabled readonly>
                                    <div id="student-suggestions" class="dropdown"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="explanation" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="explanation" name="explanation">{{$visit->explanation}}</textarea>
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

    <!-- Modal Kunjungan Baru -->
    <div class="modal fade" id="newVisitModal" tabindex="-1" aria-labelledby="newVisitModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="newVisitModalLabel">Tambah Data Kunjungan</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
			<form action="{{ route('storeVisit') }}" method="POST">
	            @csrf
	            <div class="mb-3">
	                <label for="student" class="form-label">Nama Siswa</label>
	                <input type="text" class="form-control" id="student" name="student" autocomplete="off">
                    <input type="hidden" name="student_id", id = 'student_id'>
	                <div id="student-suggestions" class="dropdown"></div>
	            </div>
	            <div class="mb-3">
	                <label for="explanation" class="form-label">Keterangan</label>
	                <textarea class="form-control" id="explanation" name="explanation"></textarea>
	            </div>
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // const studentSuggestions = {!! $studentSuggestions !!};
    const studentSuggestions = {!! $studentSuggestions !!};
    const studentInput = document.getElementById('student');
    const studentHiddenInput = document.getElementById('student_id');
    const suggestionsContainer = document.getElementById('student-suggestions');
    // console.log(studentSuggestions);
    studentInput.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        // const filteredSuggestions = studentSuggestions.filter(function(student) {
        //     return student.toLowerCase().indexOf(keyword) !== -1;
        // });
        const filteredSuggestions = search(studentSuggestions, keyword);

        names = []
        identifiers = []
        filteredSuggestions.forEach((item) => {
          // Lakukan operasi yang diinginkan pada setiap item JSON
            names.push(item.name);
            identifiers.push(item.id);
        });

        suggestionsContainer.innerHTML = '';
        // filteredSuggestions.slice(0, 5).forEach(function(suggestion) {
        names.slice(0, 5).forEach(function(suggestion) {
            const suggestionElement = document.createElement('div');
            suggestionElement.classList.add('suggestion');
            suggestionElement.innerText = suggestion;
            suggestionElement.addEventListener('click', function() {
                studentInput.value = suggestion;
                const idx = names.indexOf(suggestion)
                suggestionsContainer.innerHTML = '';
                studentHiddenInput.dispatchEvent(new Event('input'));
                // Set nilai langsung ke value saat saran diklik
                studentHiddenInput.setAttribute('value', identifiers[idx]);
            });
            suggestionsContainer.appendChild(suggestionElement);
        });
    });

    suggestionsContainer.addEventListener('click', function(event) {
        const clickedSuggestion = event.target.innerText;
        studentInput.value = clickedSuggestion;
        suggestionsContainer.innerHTML = '';
        // Set nilai langsung ke value saat saran diklik
        studentHiddenInput.setAttribute('value', identifiers[idx]);
        // studentHiddenInput.value = identifiers[idx];
    });
</script>
@endsection