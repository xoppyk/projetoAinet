<?php

namespace App\Http\Controllers;

use DateTime;

use App\Account;
use App\User;
use App\AccountType;
use Illuminate\Http\Request;
use \App\Movement;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;

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
        $validated = $request->validated();
        $validated['date'] = $this->validateData($validated['date']);
        $validated['owner_id'] = \Auth::id();
        Account::create($validated);
        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account Added Successfully']);
    }

    private function validateData($dateToValidate)
    {
        if ($dateToValidate != null) {
            $date = DateTime::createFromFormat('d/m/Y H:i:s', $dateToValidate.'00:00:00');
            return $date->format('Y-m-d H:i:s');
        }
        return \Carbon\Carbon::now();
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
            $this->recalculateBalance($account);
        }
        $account->fill($validated);
        $account->save();

        return redirect()
            ->route('accounts.ofUser', \Auth::user())
            ->with(['type' => 'success', 'message' => 'Account Edited Successfully']);
    }

    private function recalculateBalance($account)
    {
        // code...
    }
}
