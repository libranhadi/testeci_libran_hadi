@extends('layouts.app')
@section('title', 'Employee')

@section('content')
    <div class="container">
        <div id="message"></div>
        <h2>Tambah Karyawan Baru</h2>

        <form id="createForm">
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="ttl">TTL:</label>
                <input type="date" class="form-control" id="ttl" name="ttl" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="id_jabatan">Jabatan:</label>
                <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                    <option value="">Pilih Jabatan</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id_jabatan }}">{{ $position->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_dept">Department:</label>
                <select class="form-control" id="id_dept" name="id_dept" required>
                    <option value="">Pilih Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id_dept }}">{{ $department->nama_dept }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-primary mt-2" id="saveBtn">Submit</button>
        </form>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            $('#saveBtn').click(function() {
                var nik = $('#nik').val();
                var nama = $('#nama').val();
                var ttl = $('#ttl').val();
                var alamat = $('#alamat').val();
                var idJabatan = $('#id_jabatan').val();
                var idDept = $('#id_dept').val();
                
                $.ajax({
                    type: 'POST',
                    url: '/api/employees/store',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nik': nik,
                        'nama': nama,
                        'ttl': ttl,
                        'alamat': alamat,
                        'id_jabatan': idJabatan,
                        'id_dept': idDept
                    },
                    success: function(response) {
                        alert('Karyawan berhasil ditambahkan.');
                    },
                    error: function(xhr) {
                        var err = JSON.parse(xhr.responseText);
                        $('#message').html('');
                        if (err.errors) {
                            var errorHtml = '<ul>';
                            
                            $.each(err.errors, function(key, value) {
                                errorHtml += '<li>' + value + '</li>';
                            });
                            
                            errorHtml += '</ul>';
                            
                            $('#message').html('<div class="alert alert-danger">' + errorHtml + '</div>');
                        } else {
                            $('#message').html('<div class="alert alert-danger"> Sorry, something went wrong please try again later!</div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection