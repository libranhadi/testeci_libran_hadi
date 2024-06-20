@extends('layouts.app')
@section('title', 'Department')
@section('content')
    <div class="container">
        <div id="message"></div>
        <h2>Add New Level</h2>

        <form id="createForm">
            <div class="form-group">
                <label for="nama_level">Nama Level:</label>
                <input type="text" class="form-control" id="nama_level" name="nama_level" required>
            </div>
            <button type="button" class="btn btn-primary mt-2" id="saveBtn">Submit</button>
        </form>
    </div>
@endsection
@section("scripts")
    <script>
        $(document).ready(function() {
            $('#saveBtn').click(function() {
                var namaLevel = $('#nama_level').val();
                $.ajax({
                    type: 'POST',
                    url: '/api/levels/store',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nama_level': namaLevel
                    },
                    success: function(response) {
                        alert('Level created successfully.');
                        // Redirect or navigate to another page if needed
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