<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Click;

class PhishedListController extends Controller
{
    public function index() {
        $clicks = Click::orderBy('id', 'desc')->paginate(8);
        return inertia('phishedlist/index', [
            'clicks' => $clicks,
        ]);
    }

    public function edit(Click $click) {
        return inertia('phishedlist/edit', compact('click'));
    }

    public function update(Click $click, Request $request) {
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

        return redirect('phishedlist/index');
    }

    public function destroy(Click $click) {
        $click->delete();
        return redirect('phishedlist/index')->with('success', 'Entry deleted successfully!');
    }
}
