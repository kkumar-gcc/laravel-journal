<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Access\Gate;

class BlogPolicy
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Blog $blog)
    {
        if ($blog->published) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can('view unpublished posts')) {
            return true;
        }

        // authors can view their own unpublished blogs
        return $user->id == $blog->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('create blogs')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Blog $blog)
    {
        if ($user->can('edit all blogs')) {
            return true;
        }
        
        if ($user->can('edit own blogs')) {
            return $user->id == $blog->user_id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Blog $blog)
    {
        if ($user->can('delete all blogs')) {
            return true;
        }

        if ($user->can('delete own blogs')) {
            return $user->id == $blog->user_id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Blog $blog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Blog $blog)
    {
        //
    }
}
