<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function showDashboard()
    {
        $totalCounts = $this->getCounts([
            'Users' => 'App\Models\User',
            'Categories' => 'App\Models\Category',
            'Audios' => 'App\Models\Audio',
            'Roles' => 'Spatie\Permission\Models\Role'
        ]);

        return view('pages.dashboard.index', $totalCounts);

    }

    private function getCounts($tables)
    {
        $counts = [];
        foreach ($tables as $key => $model) {
            $counts["total{$key}"] = $model::count();
            $counts["total{$key}Today"] = $model::whereDate('created_at', today())->count();
        }

        return $counts;
    }

}
