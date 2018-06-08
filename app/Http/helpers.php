<?php
use App\Movement;


function is_selected($current, $expected, $output = 'selected')
{
    if ($current == $expected) {
        return $output;
    }
}

function is_checked($current, $expected)
{
    return is_selected($current, $expected, 'checked');
}

function profile_photo($user)
{
    if ($user->profile_photo) {
        return asset('storage/profiles/'.$user->profile_photo);
    }
    return asset('storage/profiles/no_photo_profile.png');
}

function userClassBlocked($user)
{
    if ($user->blocked) {
        return 'user-is-blocked';
    }
    return '';
}

function userClassAdmin($user)
{
    if ($user->admin) {
        return 'user-is-admin';
    }
    return '';
}

function userClassAssossiate($user)
{
    if ($user->admin) {
        return 'user-is-admin';
    }
    return '';
}

function leftNavBarActive($value)
{
    return $value == Route::currentRouteName() ? 'active' : '';
}

function calculateEndBalance($startBalance, $value, $type)
{
    if ($type === 'revenue') {
        return $startBalance + $value;
    } elseif ($type === 'expense') {
        return $startBalance - $value;
    } else {
        return 'something wrong';
    }
}

function differentType($type)
{
    if ($type === 'revenue' ) {
        return 'expense';
    }
    return 'revenue';
}

function to_cents($value)
{
    return bcmul($value, 100, 0);
}

function calculateBalanceFromDate($date, $movement)
{
    $account = $movement->account;
    $oldStartBalance = getFirstMovementBeforeDate($date, $account->id);
    $startBalance = $oldStartBalance->end_balance;


    $allMovements = getAllMovemetFromDate($date, $account->id);

    if (empty($oldStartBalance)) {
        $startBalance = $account->start_balance;
    }

    foreach ($allMovements as $mov) {
        $mov->start_balance = $startBalance;
        $mov->end_balance = calculateEndBalance($mov->start_balance, $mov->value, $mov->type);
        $mov->save();

        $startBalance = $mov->end_balance;
    }
}

function getAllMovemetFromDate($date, $account_id)
{
    return $allMovementsFrom = Movement::where(['account_id', $account_id], ['date', '>=', $date])->orderBy('date', 'asc');
}

function getFirstMovementBeforeDate($date, $account_id)
{
    return $date = Movement::where(['account_id', $account_id], ['date', '<', $date])->orderBy('date', 'desc')->first();
}
