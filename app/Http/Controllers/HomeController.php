<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $treatments = Treatment::all();
        return view('indexHome', compact('treatments'));

    }

    public function indexBookings()
    {

        return view('bookings.indexBooking');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:30',
            'phone_number' => 'required|digits:9',
            'treatment_name' => 'required|string',
            'treatment_date' => 'required|date',
            'hour' => 'required|numeric'

        ]);

        $booking = new Booking();
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone_number = $request->phone_number;
        $booking->treatment_name = $request->treatment_name;
        $booking->treatment_date = date("Y-m-d H:i:s", strtotime($request->treatment_date) + ($request->hour) * 3600);

        $treatmentid = Treatment::where('name', $booking->treatment_name)->first()->id;

        $reservations = Reservation::all('treatment_id', 'reservation_date');
        foreach ($reservations as $key) {
            if (Carbon::createFromFormat("Y-m-d H:i:s", $booking->treatment_date)->eq(Carbon::createFromFormat("Y-m-d H:i:s", $key['reservation_date']))
                && $treatmentid == $key['treatment_id']) {
                return redirect()->route('home.index')
                    ->with('error', 'Please choose another hour or date.');
            }
        }
        $booking->save();

        return redirect()->route('home.index')
            ->with('success', 'Booking has been made successfully.');
    }

    public function destroy($id)
    {

        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings')
            ->with('success', 'Booking has been deleted successfully');
    }

    public function addBooking($id)
    {

        $var = 0;

        $booking = Booking::find($id);

        $clients = Client::all('id', 'email');

        foreach ($clients as $key) {
            if ($booking['email'] == $key['email']) {

                $client = Client::find($key[$id]);

                $var = 1;
            }
        }

        if ($var == 0) {

            $validatedData = $booking->validate([
                'name' => 'required|string|alpha|max:20',
                'description' => 'required|string|max:150',
                'price' => 'required|digits_between:2,3'
            ]);

            Client::create($validatedData);

            foreach ($clients as $key) {
                if ($booking['email'] == $key['email']) {

                    $client = Client::find($key[$id]);

                }
            }

        }

        return $client;
    }


}
