<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        return view('treatments.indexTreatment');
    }

    public function create()
    {

        return view('treatments.createTreatment');
    }

    public function edit($id)
    {

        $treatment = Treatment::findOrFail($id);

        return view('treatments.editTreatment', compact('treatment'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|alpha|max:20',
            'description' => 'required|string|max:150',
            'price' => 'required|digits_between:2,3'
        ]);

        Treatment::create($validatedData);
        return redirect()->route('treatments')
            ->with('success', 'Treatment has been added successfully.');
    }


    public function show(Treatment $treatment)
    {
        return view('treatments.indexTreatment', compact('treatment'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:150',
            'price' => 'required|digits_between:2,3'
        ]);

        Treatment::whereId($id)->update($validatedData);

        return redirect()->route('treatments')
            ->with('success', 'Treatment Has Been updated successfully');
    }


    public function destroy($id)
    {

        $treatment = Treatment::findOrFail($id);
        $treatment->delete();
        return redirect()->route('treatments')
            ->with('success', 'Treatment has been deleted successfully');
    }
}
