@extends('layouts.app')
@section('title', 'Department')
@section('content')
    <div class="container">
        <h2>Edit Level</h2>

        <form id="editForm">
            <input type="hidden" id="levelId" name="id" value="{{ $level->id_level }}">
            <div class="form-group">
                <label for="nama_level">Nama Level:</label>
                <input type="text" class="form-control" id="nama_level" name="nama_level" value="{{ $level->nama_level }}" required>
            </div>
            <button type="button" class="btn btn-primary mt-2" id="updateBtn">Update</button>
        </form>
    </div>
@endsection
@section("scripts")
    <script>
        $(document).ready(function() {
            $('#updateBtn').click(function() {
                var levelId = $('#levelId').val();
                var namaLevel = $('#nama_level').val();
                $.ajax({
                    type: 'PUT',
                    url: '/api/levels/update/' + levelId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nama_level': namaLevel
                    },
                    success: function(response) {
                        alert('Level updated successfully.');
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