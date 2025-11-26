<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('moderator.dashboard', compact('groups'));
    }
}
