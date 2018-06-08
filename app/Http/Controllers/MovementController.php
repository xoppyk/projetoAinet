<?php

namespace App\Http\Controllers;

use App\Account;
use App\Document;
use App\Movement;
use App\MovementCategorie;
use Illuminate\Http\Request;


use App\Http\Requests\MovementStoreRequest;
use App\Http\Requests\MovementUpdateRequest;

use Illuminate\Support\Facades\Storage;

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
        $movement->type = $movement->movementCategorie->type;

        $movement->value = $movement->value;

        $movement->account_id = $account->id;
        $movement->start_balance = $account->current_balance;
        $movement->end_balance = calculateEndBalance($movement->start_balance, $movement->value, $movement->type);
        $account->current_balance = $movement->end_balance;
        $account->save();
        $movement->save();

        if (isset($validated['document_file'])) {
            $document = new Document;
            $document->type = $validated['document_file']->extension();
            $document->description = $validated['document_description'] ?? '';
            $document->original_name = 'invoice.'.$document->type;
            $document->save();
            $movement->document()->associate($document);
            $movement->save();
            $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
            // dd($document, $movement);
        }

        return redirect()
            ->route('movements.index', $account)
            ->with(['type' => 'success', 'message' => 'Movement Added Successfully']);
    }

    public function edit(Movement $movement)
    {
        $movementCategories = MovementCategorie::all();
        return view('movements.edit', compact('movement', 'movementCategories'));
    }

    public function update(MovementUpdateRequest $request, Movement $movement)
    {
        $validated = $request->validated();
        $account = $movement->account;

        if ($movement->date != $validated['date'] || $movement->value != $validated['value'] || $movement->movement_category_id->type != $validated['movement_category_id']->type) {
            calculateBalanceFromDate($movement);
        }

        $movement->fill($validated);

        if (isset($validated['document_file'])) {
            $document = new Document;
            $document->type = $validated['document_file']->extension();
            $document->description = $validated['document_description'] ?? '';
            $document->original_name = 'invoice.'.$document->type;
            $document->save();
            $movement->document()->associate($document);
            $movement->save();
            $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
            // dd($document, $movement);
        }

        $account->save();
        $movement->save();

        return redirect()
            ->route('movements.index', $movement->account_id)
            ->with(['type' => 'success', 'message' => 'Movement Edited Successfully']);
    }

    public function destroy(Movement $movement)
    {
        //pegar no end balance do seguinte
        if (isset($movement->document_id)) {
            $document = $movement->document()->first();
            Storage::delete('/documents/'.$movement->account_id.'/'.$movement->id.'.'.$document->type);
            $movement->document()->dissociate();
        }
        $movement->delete();
        return redirect()
            ->back()
            ->with(['type' => 'success', 'message' => 'Movement Deleted Successfully']);
    }
}
