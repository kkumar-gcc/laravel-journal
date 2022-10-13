<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Tag;
use App\Policies\CommentPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\TagPolicy;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\DatabaseNotification as Notification;
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
        Reply::class => ReplyPolicy::class,
        Notification::class => NotificationPolicy::class,
        Tag::class => TagPolicy::class,
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
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
        });

    }
}
