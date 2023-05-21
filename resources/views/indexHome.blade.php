<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Spa Home</title>
    <style>
        @import
        url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: 'Rubik', sans-serif;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Spa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active">Home</a>

            @if(isset(Auth::user()->email))
                <a class="nav-item nav-link" href="{{route("reservations.index")}}">Reservations</a>
                <a class="nav-item nav-link" href="{{route("treatmentsCRUD.index")}}">Treatments</a>
                <a class="nav-item nav-link" href="{{route("clientsCRUD.index")}}">Clients</a>
                <a class="nav-item nav-link" href="{{route("bookings")}}">Bookings</a>
                <a class="nav-item nav-link" href="{{route("users")}}">Users</a>
        </div>
    </div>
                <a class="navbar-item nav-link" href="{{url('/login/logout')}}">Logout</a>
            @else
            </div>
    </div>
                <a class="navbar-item nav-link" href="{{url('/login')}}">Login</a>
            @endif




</nav>
<div id="start"></div>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button style="display: none" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button style="display: none" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button style="display: none" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('img/spa-1.png')}}" class="d-block w-100 scale-60" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Great pleasure!</h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('img/spa-2.png')}}" class="d-block w-100 scale-60" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Relaxation!</h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('img/spa-3.png')}}" class="d-block w-100 scale-60" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Proffesional equipment!</h1>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div id="pricing"></div>
<div class="container md-5 mt-5">
    <h1>Pricing</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Treatement Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($treatments as $t)
            <tr>
                <th scope="row">{{$t->id}}</th>
                <td>{{$t->name}}</td>
                <td>{{$t->description}}</td>
                <td>{{$t->price}}PLN</td>
            </tr>
        @empty

        @endforelse


        </tbody>
    </table>
</div>
<div id="inne"></div>
<div class="container mt-5 md-5">
    <div class="row">
        <div class="col-md-6 md-5">
            <h2>About our spa...</h2>
            <p>Movie with our proffesional facial treatment. More videos with our treatments soon...</p>
            <iframe width="100%" height="315px" class="embed-responsive-item" src="https://www.youtube.com/embed/rMO_mCbNgQo" allowfullscreen></iframe>
        </div>
        <div class="col-md-6 md-5">
            <h2>Book your treatment...</h2>
            <form action="{{ route('home.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input type="text" class="form-control"  name="name">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control"  aria-describedby="emailHelp" name="email">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" name="phone_number">
                    @error('phone_number')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Treatment</label>
                    <select class="form-select" aria-label="Default select example" name="treatment_name">
                        @foreach($treatments as $treatment)
                            <option>{{$treatment->name}}</option>
                        @endforeach
                        @error('treatment_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reservationDate">Date</label>
                    <input name="treatment_date" id="startDate" class="form-control" type="date"
                           min="<?php echo date('Y-m-d');?>"/>
                    @error('reservation_date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <span id="startDateSelected"></span>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <label for="exampleFormControlSelect1">Hour</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="hour" type="number">
                        <option value="8">8:00</option>
                        <option value="9">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                    </select>
                </div>
                <div class="mb-3 d-md-flex justify-content-md-end"><button type="submit" class="btn btn-primary">Send</button></div>
            </form>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

        </div>
        <div class="container-fluid bg-light">
            <div class="row text-center pt-2 pb-2">
                <div class="text-dark">
                    &copy; Spa - 2022
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
