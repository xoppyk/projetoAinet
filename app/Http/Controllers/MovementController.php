<?php

namespace App\Http\Controllers;

use App\Account;
use App\Document;
use App\Http\Requests\MovementStoreRequest;
use App\Http\Requests\MovementUpdateRequest;
use App\Movement;
use App\MovementCategorie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovementController extends Controller
{
    const NUM_PER_PAGE = 10;

    public function index(Account $account)
    {
        $movements = $account->movements()->with('movementCategorie')->orderBy('date', 'asc')->paginate(static::NUM_PER_PAGE);
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
        $movement->start_balance = 0;
        $movement->end_balance = 0;
        $movement->account_id = $account->id;
        $date_of_creation = Carbon::now()->format('Y-m-d H:i:s');
        $movement->created_at = $date_of_creation;
        $movement->save();
        reCalculateBalanceFromDate($movement->date,$account);
        

        if (isset($validated['document_file'])) {
            $document = new Document;
            $document->type = $validated['document_file']->extension();
            $document->description = $validated['document_description'] ?? '';
            $document->original_name = $validated['document_file']->name;
            $document->created_at = $date_of_creation;
            $document->save();
            $movement->document()->associate($document);
            $movement->save();
            $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
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
        $movement->fill($validated);
        $movement->movementCategorie()->associate($validated['movement_category_id']);
        $movement->type = $movement->movementCategorie()->first()->type;
        $movement->save();

        if (isset($validated['document_file'])) {
            $document = new Document;
            $document->type = $validated['document_file']->extension();
            $document->description = $validated['document_description'] ?? '';
            $document->original_name = $validated['document_file']->name;
            $document->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $document->save();
            $movement->document()->associate($document);
            $movement->save();
            $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
        }

        

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

    public function addDocument(Movement $movement, $validated,$request){
        if (isset($validated['document_file'])) {
            $document = new Document;
            $document->type = $validated['document_file']->extension();
            $document->description = $validated['document_description'] ?? '';
            $document->original_name = $validated['document_file']->name;
            $document->created_at = $date_of_creation;
            $document->save();
            $movement->document()->associate($document);
            $movement->save();
            $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
        }
    }
}
