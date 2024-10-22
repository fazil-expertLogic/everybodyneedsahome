<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PropertiesController extends Controller
{
    // Show login form
    public function addProperties()
    {
        return view('livewire.properties.addProperty');
    }

    
}
