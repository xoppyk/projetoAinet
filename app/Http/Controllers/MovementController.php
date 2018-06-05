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
        $movement->value = (int)$movement->value;
        $movement->account_id = $account->id;
        $movement->start_balance = $account->current_balance;
        $movement->end_balance = $this->calculateEndBalance($movement->start_balance, $movement->value, $movement->type);
        $account->current_balance = $movement->end_balance;
        // dd($movement);
        $account->save();

        $movement->save();
        return redirect()
            ->route('movements.index', $account)
            ->with(['type' => 'success', 'message' => 'Movement Added Successfully']);
    }

    public function calculateEndBalance($startBalance, $value, $type)
    {
        if ($type === 'revenue') {
            return $startBalance + $value;
        } elseif ($type === 'expense') {
            return $startBalance - $value;
        } else {
            return 'some wrong';
        }
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
            ->route('home')
            ->with(['type' => 'success', 'message' => 'Movement Edited Successfully']);
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();
        return redirect()->back()->with(['type' => 'success', 'message' => 'Movement Edited Successfully']);
    }
}
