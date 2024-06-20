@extends('layouts.app')

@section('title', 'Task 1')

@section('content')
    <div class="container">
        <div id="message">
        </div>
        <div>Task 1</div>
        <form id="generateStarForm" method="POST">
            @csrf
            <div class="form-group mb-3">
                <select id="type" class="form-control mt-3" name="type">
                    <option value="type_one"> Tipe 1</option>
                    <option value="type_two"> Tipe 2</option>
                    <option value="type_three"> Tipe 3</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan dalam bentuk angka lalu tekan submit" name="number"> 
            </div>
            <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
        </form>
        <div id="output">
        </div>
    </div>
@endsection
@section("scripts")
<script>
    $(document).ready(function() {
        $('#submitButton').click(function(e) {
            e.preventDefault();
            
            var formData = $('#generateStarForm').serialize(); 
            $.ajax({
                type: 'POST',
                url: '/api/generate/star',
                data: formData,
                success: function(response) {
                    $('#message').html('');
                    $('#output').html('');
                    $('#message').html('<div class="alert alert-success">Successfully, generate star!</div>')
                    $('#output').html(response.html);
                },
                error: function(xhr, status, error) {
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