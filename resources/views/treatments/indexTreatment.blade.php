<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


    <title>Treatments</title>

    <!-- TailwindCSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>

    @livewireStyles
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Spa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{route("home.index")}}">Home</a>
            <a class="nav-item nav-link" href="{{route("reservations.index")}}">Reservations</a>
            <a class="nav-item nav-link active">Treatments </a>
            <a class="nav-item nav-link" href="{{route("clientsCRUD.index")}}">Clients</a>
            <a class="nav-item nav-link" href="{{route("bookings")}}">Bookings</a>
            <a class="nav-item nav-link" href="{{route("users")}}">Users</a>
        </div>
    </div>
    @if(isset(Auth::user()->email))
        <a class="navbar-item nav-link" style="color:cyan;" href="{{url('/login/logout')}}">Logout</a>
    @else
        <script>window.location = "{{route('home.index')}}"</script>
    @endif
</nav>

<div class="container mx-auto">
    <h1 class="text-3xl text-center my-10">Treatments</h1>
    <button onClick="window.location='{{route('treatmentsCRUD.create')}}'" class="btn btn-success">Add Treatment</button>
    <div><br></div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <livewire:treatments-table>
</div>

@livewireScripts
</body>
</html>
