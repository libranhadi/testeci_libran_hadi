@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
    <div class="container">
        <h2>Daftar Karyawan</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Karyawan Baru</a>
        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->nik }}</td>
                        <td>{{ $employee->nama }}</td>
                        <td>{{ $employee->ttl }}</td>
                        <td>{{ $employee->alamat }}</td>
                        <td>{{ $employee->position->nama_jabatan ?? '' }}</td>
                        <td>{{ $employee->department->nama_dept ?? '' }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee->id_karyawan) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $employee->id_karyawan }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function() {
                var karyawanId = $(this).data('id');
                if (confirm("Apakah Anda yakin ingin menghapus karyawan ini?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/employees/delete/' + karyawanId,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            alert('Karyawan berhasil dihapus.');
                            window.location.reload(); 
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Terjadi kesalahan saat menghapus karyawan.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
