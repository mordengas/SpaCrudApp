<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            rel="sylesheet"></script>

    <title>Reservations</title>
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
@if(isset(Auth::user()->email))
<body>


<div class="containter mt-2">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h5>Add Reservation</h5>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('reservations.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div>
        <form action="{{route('reservations.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-3 col-sm-6">
                <label for="exampleFormControlSelect1">Client</label>
                <select class="form-control" id="exampleFormControlSelect1" name="client_id">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                    @error('client_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </select>
            </div>

            <div class="col-lg-3 col-sm-6">
                <label for="exampleFormControlSelect1">Treatment</label>
                <select class="form-control" id="exampleFormControlSelect1" name="treatment_id">
                    @foreach($treatments as $treatment)
                        <option value="{{$treatment->id}}">{{$treatment->name}}</option>
                    @endforeach
                    @error('treatment_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </select>
            </div>

            <div class="col-lg-3 col-sm-6">
                <label for="reservationDate">Date</label>
                <input name="reservation_date" id="startDate" class="form-control" type="date"
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

                <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
</div>


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



@livewireScripts
</body>

@else
    <script>window.location = "{{route('home.index')}}"</script>
@endif
</html>
