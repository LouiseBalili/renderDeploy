<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Click;
use Carbon\Carbon;

class ClickController extends Controller
{
    public function trackClick(Request $request)
    {
        $email = $request->query('email');

        $name = $request->input('name', '');
        $campaigndepartment = $request->input('campaigndepartment', '');
        $clickedAt = Carbon::now('Asia/Manila');

        if($email) {
            Click::create([
                'email' => $email,
                'name' => $name,
                'campaigndepartment' => $campaigndepartment,
                'clicked_at' => $clickedAt,
            ]);
        }

        return redirect()->route('Sprout Login');
    }
}
