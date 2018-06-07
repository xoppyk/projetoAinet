<?php

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
