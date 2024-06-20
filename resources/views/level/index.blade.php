@extends('layouts.app')

@section('title', 'Level')

@section('content')
    <div class="container">
    <h2>List of Levels</h2>
        <a href="{{ route('levels.create') }}" class="btn btn-primary mb-3">Add New Level</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $level->nama_level }}</td>
                        <td>
                            <a href="{{ route('levels.edit', $level->id_level) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $level->id_level }}">Delete</button>
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
                var levelId = $(this).data('id');
                if (confirm("Are you sure you want to delete this level?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/levels/delete/' + levelId,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            alert('Level deleted successfully.');
                            window.location.reload(); 
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Error occurred while deleting level.');
                        }
                    });
                }
            });
        });
    </script>
@endsection