<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class ClinicController extends Controller
{
    public function createForm()
    {
        return view('clinics.addclinic');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'status' => 'required',
            'doctor_name' => 'required', // Ensure doctor_name is required
        ]);

        $clinic = Clinic::create($request->all());

        // Redirect back to the create form with a success message
        return redirect()->route('clinic.create.form')->with('success', 'Clinic created successfully');
    }

    public function viewClinics()
    {
        // Retrieve all clinics from the database
        $clinics = Clinic::all();

        // Return the view for clinic listing
        return view('clinics.clinicview', compact('clinics'));
    }

    public function archive($id)
    {
        $clinic = Clinic::find($id);

        if ($clinic) {
            $clinic->delete();
            return redirect()->route('clinic.view')->with('success', 'Clinic archived successfully');
        }

        return redirect()->route('clinic.view')->with('error', 'Clinic not found');
    }
    public function edit($id)
    {
        $clinic = Clinic::find($id);
    
        if (!$clinic) {
            return redirect()->route('clinic.view')->with('error', 'Clinic not found');
        }
    
        return view('clinics.edit', compact('clinic'));
    }

        public function update(Request $request, $id)
    {
        $clinic = Clinic::find($id);

        if ($clinic) {
            $request->validate([
                'name' => 'required',
                'location' => 'required',
                'contact' => 'required',
                'status' => 'required',
                'doctor_name' => 'required', // Ensure doctor_name is required
            ]);

            $clinic->update($request->all());
            return redirect()->route('clinic.view')->with('success', 'Clinic updated successfully');

        }

        return redirect()->route('clinic.view')->with('error', 'Clinic not found');
    }
}
