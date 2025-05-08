<?php

namespace App\Http\Controllers;

use App\Models\mailinput;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StoremailinputRequest;
use App\Http\Requests\UpdatemailinputRequest;

class MailinputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mailinputs = mailinput::orderBy('id', 'desc')->paginate(8);
        return inertia('phishedlogin/index', [
            'mailinputs' => $mailinputs,
        ]);
    }

    public function trackSubmit(Request $request) {
        $email = $request->input('email', '');
        $name = $request->input('name', '');
        $campaigndepartment = $request->input('campaigndepartment', '');
        $clickedAt = Carbon::now('Asia/Manila');

        mailinput::create([
                'email' => $email,
                'name' => $name,
                'campaigndepartment' => $campaigndepartment,
                'clicked_at' => $clickedAt,
        ]);

        return redirect('/phished');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremailinputRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(mailinput $mailinput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mailinput $mailinput)
    {
        return inertia('phishedlogin/edit', compact('mailinput'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemailinputRequest $request, mailinput $mailinput)
    {
        $request->validate([
            'email' => 'string|required',
            'name' => 'string|required',
            'campaigndepartment' => 'string|required',
        ]);

        $click->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'campaigndepartment' => $request->input('campaigndepartment'),
        ]);

        return redirect('phishedlogin/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mailinput $mailinput)
    {
        $mailinput->delete();
        return redirect('phishedlogin/index')->with('success', 'Entry deleted successfully!');
    }
}
