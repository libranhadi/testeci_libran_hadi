@extends('layouts.app')
@section('title', 'Department')
@section('content')
    <div class="container">
        <h2>Edit Department</h2>

        <form id="editForm">
            <input type="hidden" id="deptId" name="id" value="{{ $department->id_dept }}">
            <div class="form-group">
                <label for="nama_dept">Nama Department:</label>
                <input type="text" class="form-control" id="nama_dept" name="nama_dept" value="{{ $department->nama_dept }}" required>
            </div>
            <button type="button" class="btn btn-primary mt-2" id="updateBtn">Update</button>
        </form>
    </div>
@endsection
@section("scripts")
<script>
        $(document).ready(function() {
            $('#updateBtn').click(function() {
                var deptId = $('#deptId').val();
                var namaDept = $('#nama_dept').val();
                $.ajax({
                    type: 'PUT',
                    url: '/api/departments/update/' + deptId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nama_dept': namaDept
                    },
                    success: function(response) {
                        alert('Department updated successfully.');
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