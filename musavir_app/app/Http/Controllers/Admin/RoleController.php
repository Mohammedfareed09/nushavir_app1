<?php
namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); // Retrieve all users with their roles
        $roles = Role::all(); // Retrieve all roles
        return view('Admin.roles.index', compact('users', 'roles'));
    }

    public function showusers()
    {
        return view('user.register');
    }

}
