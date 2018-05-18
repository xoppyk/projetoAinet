<?php

function is_selected($current, $expected, $output = 'selected')
{
    if ($current === $expected) {
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