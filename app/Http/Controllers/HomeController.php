<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spoiler;
use App\Models\PhoneNumber;

class HomeController extends Controller
{
    public function index ()
    {
        $spoilers = Spoiler::latest()->get();

        $phoneNumbers = PhoneNumber::all();

        return view('home', compact('spoilers', 'phoneNumbers'));
    }

    public function storeSpoiler(Request $request)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);

        Spoiler::create($request->only(['message']));

        return back()->with('success', 'spoiler has been added successfully');
    }

    public function storePhoneNumber(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required'
        ]);

        PhoneNumber::create($request->only(['phone_number']));

        return back()->with('success', 'Phone Number has been added successfully');
    }
}
