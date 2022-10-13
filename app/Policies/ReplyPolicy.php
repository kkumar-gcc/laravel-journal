<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('create replies')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Reply $reply)
    {
        if ($user->can('edit all replies')) {
            return true;
        }

        if ($user->can('edit own replies')) {
            return $user->id == $reply->user_id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Reply $reply)
    {
        if ($user->can('delete all replies')) {
            return true;
        }

        if ($user->can('delete own replies')) {
            return $user->id == $reply->user_id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Reply $reply)
    {
        //
    }
}
