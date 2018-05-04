<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show Welcome Page with information about the total of registered users, total number of accounts and movements registered on the platform.
     */
    public function showWelcomePage()
    {
        $totalOfUsers = \App\User::get()->count();
        $totalOfAccounts = \App\Account::get()->count();
        $totalOfMovements = \App\Movement::get()->count();
        return view('welcome', compact('totalOfUsers', 'totalOfAccounts', 'totalOfMovements'));
    }
}
