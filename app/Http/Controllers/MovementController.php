<?php

namespace App\Http\Controllers;

use App\Account;
use App\Movement;
use App\MovementCategorie;
use Illuminate\Http\Request;


use App\Http\Requests\MovementStoreRequest;

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

    public function store(MovementStoreRequest $request, Account $account)
    {
        $movement = new Movement;
        $validated = $request->validated();
        $movement->fill($validated);
        $movement->account_id = $account->id;
        $movement->start_balance = $account->current_balance;
        $movement->end_balance = calculateEndBalance($movement->start_balance, $movement->value, $movement->type);
        $account->current_balance = $movement->end_balance;
        $account->save();
        $movement->save();
        return redirect()
            ->route('movements.index', $account)
            ->with(['type' => 'success', 'message' => 'Movement Added Successfully']);
    }

    public function edit(Movement $movement)
    {
        $movementCategories = MovementCategorie::all();
        return view('movements.edit', compact('movement', 'movementCategories'));
    }

    public function update(MovementStoreRequest $request, Movement $movement)
    {
        $validated = $request->validated();
        $movement->fill($validated);
        // $movement->start_balance = $account->current_balance;
        // $movement->end_balance = $this->calculateEndBalance($movement->start_balance, $movement->value, $movement->type);
        // $account->current_balance = $movement->end_balance;
        // $account->save();
        $movement->save();
        return redirect()
            ->route('movements.index', $movement->account()->get()->id)
            ->with(['type' => 'success', 'message' => 'Movement Edited Successfully']);
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();
        return redirect()
            ->back()
            ->with(['type' => 'success', 'message' => 'Movement Deleted Successfully']);
    }
}
