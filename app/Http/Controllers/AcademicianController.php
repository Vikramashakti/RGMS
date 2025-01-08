<?php

namespace App\Http\Controllers;

use App\Models\Academician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AcademicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate check: Only Admin Executive or Staff can access this
        if (Gate::denies('view-academicians')) {
            abort(403, 'You do not have permission to view academicians.');
        }

        $academicians = Academician::all();
        return view('academicians.index', compact('academicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate check: Only Admin Executive can access this
        if (Gate::denies('create-academician')) {
            abort(403, 'You do not have permission to create an academician.');
        }

        $users = User::all(); // Fetch all users
        return view('academicians.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate check: Only Admin Executive can store
        if (Gate::denies('create-academician')) {
            abort(403, 'You do not have permission to create an academician.');
        }

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:academicians,email', // Ensure correct validation rule
            'staff_number' => 'required|string|unique:academicians',
            'college' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|in:Professor,Associate Professor,Senior Lecturer,Lecturer',
            'users_id' => 'required|exists:users,id', // Ensure users_id exists in the users table
        ]);

        // Get the user by the selected user_id
        $user = User::find($request->users_id);

        if (!$user) {
            return back()->withErrors(['users_id' => 'Selected user not found.'])->withInput();
        }

        // Create the academician record and associate the user ID
        Academician::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'staff_number' => $validated['staff_number'],
            'college' => $validated['college'],
            'department' => $validated['department'],
            'position' => $validated['position'],
            'users_id' => $user->id, // Associate the user ID
        ]);

        // Redirect with success message
        return redirect()->route('academicians.index')->with('success', 'Academician created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Academician $academician)
    {
        // Gate check: Anyone can view the details, no restriction
        if (Gate::denies('view-academician', $academician)) {
            abort(403, 'You do not have permission to view this academician.');
        }

        return view('academicians.show', compact('academician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academician $academician)
    {
        // Gate check: Only Admin Executive can access this
        if (Gate::denies('edit-academician', $academician)) {
            abort(403, 'You do not have permission to edit this academician.');
        }

        return view('academicians.edit', compact('academician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academician $academician)
    {
        // Gate check: Only Admin Executive can update this
        if (Gate::denies('edit-academician', $academician)) {
            abort(403, 'You do not have permission to update this academician.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'staff_number' => 'required|string|unique:academicians,staff_number,' . $academician->id,
            'email' => 'required|email|unique:academicians,email,' . $academician->id,
            'college' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|in:Professor,Associate Professor,Senior Lecturer,Lecturer',
        ]);

        $academician->update($validated);

        return redirect()->route('academicians.show', $academician->id)
                         ->with('success', 'Academician updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academician $academician)
    {
        // Gate check: Only Admin Executive can delete
        if (Gate::denies('delete-academician', $academician)) {
            abort(403, 'You do not have permission to delete this academician.');
        }

        $academician->delete();

        return redirect()->route('academicians.index')->with('success', 'Academician deleted successfully');
    }
}
