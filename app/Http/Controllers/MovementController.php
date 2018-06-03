<?php

namespace App\Http\Controllers;

use App\Account;
use App\MovementCategorie;

use Illuminate\Http\Request;

class MovementController extends Controller
{
    const NUM_PER_PAGE = 10;

    public function index(Account $account)
    {
        $movements = $account->movements()->with('movementCategorie')->orderBy('date', 'desc')->paginate(static::NUM_PER_PAGE);
        return view('movements.index', compact('movements', 'account'));
    }

    public function create(Account $account)
    {
        $movementCategories = MovementCategorie::all();
        return view('movements.create', compact('account', 'movementCategories'));
    }
}
