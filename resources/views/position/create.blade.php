@extends('layouts.app')
@section('title', 'Jabatan')

@section('content')
    <div class="container">
        <div id="message"></div>
        <h2>Add New Jabatan</h2>

        <form id="createForm">
            <div class="form-group">
                <label for="nama_jabatan">Nama Jabatan:</label>
                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
            </div>
            <div class="form-group">
                <label for="id_level">Level :</label>
                <select class="form-control" id="id_level" name="id_level" required>
                    <option value="">Pilih Level</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id_level }}">{{ $level->nama_level }}</option>
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
                var namaJabatan = $('#nama_jabatan').val();
                var idLevel = $('#id_level').val();
                $.ajax({
                    type: 'POST',
                    url: '/api/positions/store',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nama_jabatan': namaJabatan,
                        'id_level': idLevel
                    },
                    success: function(response) {
                        alert('Jabatan created successfully.');
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