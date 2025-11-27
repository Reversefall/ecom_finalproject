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

        $totalGroups = Group::count();

        $year = now()->year;
        $groupsPerMonth = Group::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $groupsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $groupsData[$i] = $groupsPerMonth[$i] ?? 0;
        }

        return view('moderator.dashboard', compact(
            'totalGroups',
            'groupsData',
            'year'
        ));
    }
}
