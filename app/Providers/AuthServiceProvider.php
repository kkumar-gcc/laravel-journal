<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    // protected $policies = [
    //     // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    // ];
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('delete-comment',[CommentPolicy::class, 'delete']);
    }
}
