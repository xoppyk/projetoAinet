<?php

namespace App\Http\Controllers;

use App\Document;

use App\Movement;

use App\Http\Requests\DocumentStoreRequest;

class DocumentController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Movement $movement)
    {
        return view('documents.create', compact('movement'));
    }

    public function store(DocumentStoreRequest $request, Movement $movement)
    {
        $document = new Document;
        $validated = $request->validated();

        $document->type = $validated['document_file']->extension();
        $document->description = $validated['document_description'] ?? '';
        $document->original_name = 'invoice.'.$document->type;
        // $document->save();

        $request->file('document_file')->storeAs('documents/'.$movement->account_id, $movement->id.'.'.$document->type);
        $movement->document()->associate($document);
        return redirect()
            ->route('movements.index', $movement->account_id)
            ->with(['type' => 'success', 'message' => 'Document Added Successfully']);
    }

    public function destroy(Document $document)
    {
        //TODO Perguntar ao prof 1 Document -> 1 Movimento ??? como é MUITO IMPORTANTE TAMBEM PARA O SHOW DOCUMENT QUAL é a relação
        
        Storage::delete('/documents/'.$document->movement->account_id.'/'.$document->movement->id.'.'.$document->type);
        $movement->document()->dissociate();
        $movement->delete();
        return redirect()
            ->back()
            ->with(['type' => 'success', 'message' => 'Movement Deleted Successfully']);
    }

}
