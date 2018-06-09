<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountType;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use \App\Movement;

class AccountController extends Controller
{
    const NUM_PER_PAGE = 30;

    public function ofUser(User $user)
    {
        $accounts = Account::withTrashed()->where('owner_id', $user->id)->with('accountType')->paginate(static::NUM_PER_PAGE);
        // $accounts = $user->accounts()->with('accountType')->paginate(static::NUM_PER_PAGE);
        return view('accounts.ofUser', compact('accounts', 'user'));
    }

    public function ofUserOpened(User $user)
    {
        $accounts = Account::where('owner_id', \Auth::id())->with('accountType')->paginate(static::NUM_PER_PAGE);
        return view('accounts.ofUser', compact('accounts', 'user'));
    }

    public function ofUserClosed(User $user)
    {
        $accounts = Account::onlyTrashed()->where('owner_id', $user->id)->with('accountType')->paginate(static::NUM_PER_PAGE);

        return view('accounts.ofUser', compact('accounts', 'user'));
    }

    public function close(Account $account){
        $this->authorize('isOwner', $account);

        $account->delete();
        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account closed Successfully']);
    }

    public function destroy($id) {
        $account = Account::withTrashed()->findOrFail($id);

        if(!$account->movements()->get()->isEmpty() || !is_null($account->last_movement_date)){
            return abort(403, 'Can not delete account with movements');
        }

        $this->authorize('isOwner', $account);
        $account->forceDelete();

        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account deleted Successfully']);
    }

    public function reopen($id)
    {
        $account = Account::withTrashed()->findOrFail($id);

        $this->authorize('isOwner', $account);
        $account->restore();
        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account restored Successfully']);
    }

    public function create()
    {
        $accountTypes = AccountType::all();
        return view('accounts.create', compact('accountTypes'));
    }

    public function store(AccountStoreRequest $request)
    {
        $this->authorize('isOwner', $account);

        $validated = $request->validated();
        if(!isset($validated['date'])){
            $validated['date']=Carbon::now()->format('Y-m-d');
        }

        $validated['owner_id'] = \Auth::id();
        $validated['current_balance'] = $validated['start_balance'];
        Account::create($validated);
        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account Added Successfully']);
    }


    public function edit(Account $account)
    {
        $accountTypes = AccountType::all();
        return view('accounts.edit', compact('account', 'accountTypes'));
    }

    public function update(AccountUpdateRequest $request, Account $account)
    {
        $validated = $request->validated();
        if ($validated['start_balance'] != $account->start_balance) {
            $this->recalculateBalance($account, $validated['start_balance']);
        }
        $account->fill($validated);
        $account->save();

        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account Edited Successfully']);
    }

    private function recalculateBalance($account, $newStartBalance)
    {
        $movementsOfAccount = $account->movements()->orderBy('created_at', 'asc')->get();

        foreach ($movementsOfAccount as $movement) {
            $movement->start_balance = $newStartBalance;
            $newStartBalance = calculateEndBalance($newStartBalance, $movement->value, $movement->type);
            $movement->end_balance = $newStartBalance;
            $movement->save();
        }
        $account->current_balance = $newStartBalance;
        $account->save();
    }
}
