@extends('layouts.app')

@section('title', 'Department')

@section('content')
    <div class="container">
    <h2>List of Departments</h2>
        <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add New Department</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->nama_dept }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department->id_dept) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $department->id_dept }}">Delete</button>
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
                var deptId = $(this).data('id');
                if (confirm("Are you sure you want to delete this department?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/departments/delete/' + deptId,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            alert('Department deleted successfully.');
                            window.location.reload(); 
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Error occurred while deleting departments.');
                        }
                    });
                }
            });
        });
    </script>
@endsection