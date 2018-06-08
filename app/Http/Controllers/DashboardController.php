<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(User $user)
    {
        $allAccount = $user->accounts();
        $accountSum = $user->accounts()->pluck('current_balance')->sum();
        foreach ($allAccount as $account) {
            // $account->percentage = 'valor';
        }
        // fazer um met
        return view('dashboard.show', compact('accountSum'));
    }
}
