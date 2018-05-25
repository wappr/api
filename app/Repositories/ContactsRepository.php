<?php

namespace App\Repositories;

use App\Contacts;

class ContactsRepository
{
    public static function create($user_1, $user_2)
    {
        $user_a = $user_1 < $user_2 ? $user_1 : $user_2;
        $user_b = $user_1 > $user_2 ? $user_1 : $user_2;

        $contacts = new Contacts;
        $contacts->user_a = $user_a;
        $contacts->user_b = $user_b;

        return $contacts->save();
    }
}
