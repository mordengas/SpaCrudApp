<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{



    public function index($id)
    {

        $booking = Booking::find($id);

        $treatments = Treatment::all();

        $client = $this->store2($id);

        return view('bookings.addBooking',compact('booking','treatments','client'));
    }


    public function store2($id)
    {

        $var = 0;
        $booking = Booking::find($id);
        $clients = Client::all('id', 'email');

        foreach ($clients as $key) {
            if ($booking['email'] == $key['email']) {

                $client = Client::find($key['id']);

                $var = 1;
            }
        }

        if ($var == 0) {

            $tempclient = new Client();

            $tempclient->name = $booking->name;
            $tempclient->email = $booking->email;
            $tempclient->phone_number = $booking->phone_number;

            $tempclient->save();

            $clients = Client::all('id', 'email');

            foreach ($clients as $key) {
                if ($booking['email'] == $key['email']) {

                    $client = Client::find($key['id']);

                }
            }
        }

        return $client;

    }
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|numeric',
            'treatment_id' => 'required|numeric',
            'reservation_date' => 'required|date',
            'hour' => 'required|numeric'
        ]);

        $reservation = new Reservation;
        $reservation->client_id = $request->client_id;
        $reservation->treatment_id = $request->treatment_id;
        $reservation->reservation_date = date("Y-m-d H:i:s", strtotime($request->reservation_date) + ($request->hour)*3600);

        $reservations = Reservation::all('reservation_date','treatment_id','client_id');



        foreach ($reservations as $key){
            if(Carbon::createFromFormat("Y-m-d H:i:s", $reservation->reservation_date)->eq(Carbon::createFromFormat("Y-m-d H:i:s", $key['reservation_date']))
                && $reservation->treatment_id == $key['treatment_id'])

            {
                return redirect()->route('reservations.create')
                    ->with('error', 'Please choose another hour or date.');

            }

            if (Carbon::createFromFormat("Y-m-d H:i:s", $reservation->reservation_date)->eq(Carbon::createFromFormat("Y-m-d H:i:s", $key['reservation_date']))
                && $reservation->client_id == $key['client_id'])
            {
                return redirect()->route('reservations.create')
                    ->with('error', 'Client already has appointment at this time.');

            }

        }

        $reservation->save();
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation has been made successfully.');

    }
}
