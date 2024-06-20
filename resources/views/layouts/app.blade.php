<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Laravel')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Styles -->
        @yield("styles")
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 250px;
                background-color: #f8f9fa;
                border-right: 1px solid #dee2e6;
                padding-top: 20px;
            }
            .content {
                margin-left: 250px; /* Adjust based on sidebar width */
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('generator.star-form') }}">Task 1</a>
                    <a class="nav-link"  href="{{ route('generator.number-converter-form') }}">Task 2</a>
                    <a class="nav-link"  href="{{ route('levels.index') }}">Level</a>
                    <a class="nav-link"  href="{{ route('departments.index') }}">Department</a>
                    <a class="nav-link"  href="{{ route('positions.index') }}">Jabatan</a>
                    <a class="nav-link"  href="{{ route('employees.index') }}">Employee</a>
                </li>
            </ul>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>
