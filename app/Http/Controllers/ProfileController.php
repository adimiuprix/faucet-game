<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
        public function profile(){
        return view('profile');
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
        
        // Validasi
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update email
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
