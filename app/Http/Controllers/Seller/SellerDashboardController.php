<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerDashboardController extends Controller
{
    public function index()
    {
        return view('seller.dashboard');
    }
}
