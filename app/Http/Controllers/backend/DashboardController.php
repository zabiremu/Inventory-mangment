<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // DISPLAY DASHBOARD VIEW
    public function index()
    {
        $userId = Auth::user()->id;
        $userData = User::findOrFail($userId);
        return view('admin.dashboard.index',compact('userData'));
    }
    
    // Login Validation 

}
