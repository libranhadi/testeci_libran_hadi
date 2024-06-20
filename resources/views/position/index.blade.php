@extends('layouts.app')

@section('title', 'Jabatan')

@section('content')
<div class="container">
    <h2>List of Jabatan</h2>
    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Add New Jabatan</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Jabatan</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->nama_jabatan }}</td>
                    <td>{{ $position->level->nama_level ?? "" }}</td>
                    <td>
                        <a href="{{ route('positions.edit', $position->id_jabatan) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $position->id_jabatan }}">Delete</button>
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
                var jabatanId = $(this).data('id');
                if (confirm("Are you sure you want to delete this jabatan?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/positions/delete/' + jabatanId,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            alert('Jabatan deleted successfully.');
                            window.location.reload(); 
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Error occurred while deleting jabatan.');
                        }
                    });
                }
            });
        });
    </script>
@endsection