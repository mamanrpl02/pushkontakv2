<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdjustNumberController extends Controller
{
    public function index()
    {
        $member = Auth::user();

        return view('adjustNomor', compact('member'));
    }
}
