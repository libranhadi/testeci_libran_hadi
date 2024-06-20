@extends('layouts.app')

@section('title', 'Edit Jabatan')

@section('content')
    <div class="container">
        <div id="message"></div>
        <h2>Edit Jabatan</h2>

        <form id="editForm">
            <input type="hidden" id="jabatan_id" name="jabatan_id" value="{{ $position->id_jabatan }}">
            <div class="form-group">
                <label for="nama_jabatan">Nama Jabatan:</label>
                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ $position->nama_jabatan }}" required>
            </div>
            <div class="form-group">
                <label for="id_level">Level :</label>
                <select class="form-control" id="id_level" name="id_level" required>
                    <option value="">Pilih Level</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id_level }}" @if($level->id_level == $position->id_level) selected @endif>{{ $level->nama_level }}</option>
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
                var jabatanId = $('#jabatan_id').val();
                var namaJabatan = $('#nama_jabatan').val();
                var idLevel = $('#id_level').val();
                $.ajax({
                    type: 'PUT',
                    url: '/api/positions/update/' + jabatanId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nama_jabatan': namaJabatan,
                        'id_level': idLevel
                    },
                    success: function(response) {
                        alert('Jabatan updated successfully.');
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