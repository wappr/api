<?php

namespace App\Repositories;

use App\Contacts;

/**
 * App\Contacts repository to simplify tasks
 */
class ContactsRepository
{
    /**
     * Create a friendship
     *
     * @param  string $user_1 uuid of user
     * @param  string $user_2 uuid of user
     * @return bool
     */
    public static function create($user_1, $user_2)
    {
        // Figure out which uuid is less than the other and assign them to
        // variables that match the columns in the database.
        $user_a = $user_1 < $user_2 ? $user_1 : $user_2;
        $user_b = $user_1 > $user_2 ? $user_1 : $user_2;

        // Check if they're already pals, if they are, go ahead and return false
        // that way they don't become friends again.
        if(ContactsRepository::exists($user_a, $user_b)) {
            return false;
        }

        // Create their relationship as pals
        $contacts = new Contacts;
        $contacts->user_a = $user_a;
        $contacts->user_b = $user_b;

        return $contacts->save();
    }

    /**
     * Check if a friendship already exists
     *
     * @param  string $user_a uuid of user
     * @param  string $user_b uuid of user
     * @return bool
     */
    public static function exists($user_a, $user_b)
    {
        // Look to see if their pals
        $contacts = Contacts::where('user_a', $user_a)->where('user_b', $user_b)->count();

        // If the count is 0, then they aren't
        if($contacts == 0) {
            return false;
        }

        // Must've forgot they were already pals
        return true;
    }
}
