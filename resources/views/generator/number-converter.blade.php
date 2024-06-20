@extends('layouts.app')

@section('title', 'Task 2')

@section('content')
    <div class="container">
        <div id="message"></div>
        <div>Task 2</div>
        <form id="generateNumberConverter" method="POST">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan dalam bentuk angka lalu tekan submit contoh : 10000" name="number"> 
            </div>
            <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
        </form>
        <div>
            <div id="formattedCurrencyIdr"></div>
            <div id="formattedCurrencyIdrToWord"></div>
        </div>
    </div>
@endsection
@section("scripts")
<script>
    $(document).ready(function() {
        $('#submitButton').click(function(e) {
            e.preventDefault();
            
            var formData = $('#generateNumberConverter').serialize(); 
            $.ajax({
                type: 'POST',
                url: '/api/generate/number-converter',
                data: formData,
                success: function(response) {
                    console.log(response.formatted_currency_idr)
                    $('#message').html('');
                    // $('#formattedCurrencyIdr').html('');
                    // $('#formattedCurrencyIdrToWord').html('');
                    $('#formattedCurrencyIdr').html(response.formatted_currency_idr);
                    $('#formattedCurrencyIdrToWord').html(`Terbilang : ${response.formatted_number_to_word}`);
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