<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(){


        return view('reservations.indexReservation');

    }

    public function create(){
        $clients = Client::all(['id','name']);
        $treatments = Treatment::all(['id','name']);
        return view('reservations.createReservation', compact('clients','treatments'));
    }

    public function edit($id){

        $reservation = Reservation::find($id);

        $clients = Client::all(['id','name']);
        $treatments = Treatment::all(['id','name']);

        return view('reservations.editReservation', compact('reservation','clients','treatments'));
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

    public function show(Reservation $reservation)
    {
        return view('reservations.indexReservation', compact('reservation'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'client_id' => 'required|numeric',
            'treatment_id' => 'required|numeric',
            'reservation_date' => 'required|date',
            'hour' => 'required|numeric'
        ]);

        $reservation = Reservation::find($id);

        $reservation->reservation_date = date("Y-m-d H:i:s", strtotime($request->reservation_date) + ($request->hour)*3600);

        $reservations = Reservation::all('reservation_date','treatment_id','client_id');

        foreach ($reservations as $key){
            if(Carbon::createFromFormat("Y-m-d H:i:s", $reservation->reservation_date)->eq(Carbon::createFromFormat("Y-m-d H:i:s", $key['reservation_date']))
                && $reservation->treatment_id == $key['treatment_id'] && $reservation->client_id == $key['client_id'])

            {
                return redirect()->route('reservations.edit',$reservation->id)
                    ->with('error', 'Please choose another hour or date.');
            }

            if (Carbon::createFromFormat("Y-m-d H:i:s", $reservation->reservation_date)->eq(Carbon::createFromFormat("Y-m-d H:i:s", $key['reservation_date']))
                && $reservation->client_id == $key['client_id'])
            {
                return redirect()->route('reservations.edit',$reservation->id)
                    ->with('error', 'Client already has appointment at this time.');

            }
        }

        $reservation->save();
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation has been updated successfully.');

    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if(Carbon::createFromFormat("Y-m-d H:i:s", $reservation['reservation_date'])->gt(Carbon::tomorrow())){
            $reservation->delete();
            return redirect()->route('reservations.index')
                ->with('success', 'Reservation has been cancelled successfully');

        }
        return redirect()->route('reservations.index')
            ->with('error', 'You can not cancel reservation that already happened or happens in less than a day.');
    }
}
