<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Illuminate\Support\Str;


class dashboardController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $roles = $user->roles; // Access roles through the relationship
        return view('layouts.user.dashboard', compact('user', 'roles'));
    }




}
