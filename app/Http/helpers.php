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
        return (to_cents($startBalance) + to_cents($value))/100;
    } elseif ($type === 'expense') {
        return (to_cents($startBalance) - to_cents($value))/100;
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

function reCalculateBalanceFromDate($date, $account)
{
    $movementBeforeDate = getFirstMovementBeforeDate($date, $account->id);
    if (empty($movementBeforeDate)) {
        $startBalance = $account->start_balance;
    }else{
        $startBalance = $movementBeforeDate->end_balance;
    }
    $movementsToRecalculate = getAllMovemetFromDate($date, $account->id);

    foreach ($movementsToRecalculate as $mov) {
        $mov->start_balance = $startBalance;
        $mov->end_balance = calculateEndBalance($mov->start_balance, $mov->value, $mov->type);
        $mov->save();
        $startBalance = $mov->end_balance;
    }
    $account->current_balance = $movementsToRecalculate->last()->end_balance;
    $account->save();
}

function getAllMovemetFromDate($date, $account_id)
{
    return $allMovementsFrom = Movement::where('date', '>=', $date)->where('account_id','=', $account_id)->orderBy('date', 'asc')->get();
}

function getFirstMovementBeforeDate($date, $account_id)
{
    return $movement = Movement::where('date', '<', $date)->where('account_id', '=', $account_id)->orderBy('date', 'desc')->first();
}
