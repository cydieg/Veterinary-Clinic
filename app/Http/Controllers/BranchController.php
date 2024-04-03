<?php

namespace App\Http\Controllers;

use App\Models\Branch; // Update namespace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BranchController extends Controller
{
    public function createForm()
    {
        return view('branches.addbranch'); // Update view name
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'status' => 'required',
        ]);

        $branch = Branch::create($request->all()); // Update model name

        // Redirect back to the create form with a success message
        return redirect()->route('branch.create.form')->with('success', 'Branch created successfully'); // Update route name
    }

    public function viewBranches() // Update method name
    {
        // Retrieve all branches from the database
        $branches = Branch::all(); // Update model name

        // Return the view for branch listing
        return view('branches.branchview', compact('branches')); // Update view name
    }

    public function archive($id)
    {
        $branch = Branch::find($id); // Update model name

        if ($branch) {
            $branch->delete();
            return redirect()->route('branch.view')->with('success', 'Branch archived successfully'); // Update success message and route name
        }

        return redirect()->route('branch.view')->with('error', 'Branch not found'); // Update error message and route name
    }

    public function edit($id)
    {
        $branch = Branch::find($id); // Update model name
    
        if (!$branch) {
            return redirect()->route('branch.view')->with('error', 'Branch not found'); // Update error message and route name
        }
    
        return view('branches.edit', compact('branch')); // Update view name
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id); // Update model name

        if ($branch) {
            $request->validate([
                'name' => 'required',
                'location' => 'required',
                'contact' => 'required',
                'status' => 'required',
                
            ]);

            $branch->update($request->all());
            return redirect()->route('branch.view')->with('success', 'Branch updated successfully'); // Update success message and route name

        }

        return redirect()->route('branch.view')->with('error', 'Branch not found'); // Update error message and route name
    }
}
