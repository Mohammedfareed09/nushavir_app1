<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{

    public function index()
    {
        return view("Auth.two-factor-verification");
    }

    public function phone()
    {
        return view("auth.phone-verification");
    }

    public function phoneVerificationStore(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $user = auth()->user();

       if( $user->phone == $request->input('phone')){
           return redirect()->route('verify.index');
           $user->save();
       }



    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        if($request->input('verfiy-code') == $user->verification_code){
            $user->resetCode();
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['verfiy-code'=>'The verification code is invalid!']);
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
