@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="container">
    <div id="message"></div>
    <h2>Edit Karyawan</h2>

    <form id="editForm">
        <input type="hidden" id="employeeId" name="employeeId" value="{{ $employee->id_karyawan }}">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ $employee->nik }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $employee->nama }}" required>
        </div>
        <div class="form-group">
            <label for="ttl">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="ttl" name="ttl" value="{{ $employee->ttl->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $employee->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label for="id_jabatan">Jabatan:</label>
            <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                <option value="">Pilih Jabatan</option>
                @foreach ($positions as $position)
                <option value="{{ $position->id_jabatan }}" {{ $employee->id_jabatan == $position->id_jabatan ? 'selected' : '' }}>{{ $position->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_dept">Departemen:</label>
            <select class="form-control" id="id_dept" name="id_dept" required>
                <option value="">Pilih Departemen</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id_dept }}" {{ $employee->id_dept == $department->id_dept ? 'selected' : '' }}>{{ $department->nama_dept }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" class="btn btn-primary mt-2" id="updateBtn">Update</button>
    </form>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $('#updateBtn').click(function() {
            var nik = $('#nik').val();
            var nama = $('#nama').val();
            var ttl = $('#ttl').val();
            var alamat = $('#alamat').val();
            var idJabatan = $('#id_jabatan').val();
            var idDept = $('#id_dept').val();
            var empId = $('#employeeId').val();

            $.ajax({
                type: 'POST',
                url: '/api/employees/update/' + empId,
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
                    alert('Karyawan berhasil diupdate.');
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
                        $('#message').html('<div class="alert alert-danger"> Maaf, terjadi kesalahan. Silakan coba lagi nanti!</div>');
                    }
                }
            });
        });
    });
</script>
@endsection