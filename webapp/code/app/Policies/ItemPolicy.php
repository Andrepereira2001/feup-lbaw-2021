<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can create items.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Item  $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        return false;
    }
}
