<?php


namespace App\Http\Livewire;

use App\Policies\NotificationPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $notificationCount = 0;
    public $tab = 'all';

    protected $queryString = [
        'tab' => ['except' => 'all']
    ];
    public function render(): View
    {
        if ($this->validSort($this->tab)&&$this->tab!='all') {

            $unreadNotifications=Auth::user()->unreadNotifications()->get();
            $notifications=Auth::user()->readNotifications()->get();
        } else {
            $this->tab = 'all';
            $unreadNotifications=Auth::user()->unreadNotifications()->get();
            $notifications=Auth::user()->readNotifications()->get();
        }
        return view('livewire.notifications', [
            'unreadNotifications' => $unreadNotifications,
            'notifications' => $notifications,
        ]);
    }

    public function mount(): void
    {
        abort_if(Auth::guest(), 403);

        $this->notificationCount = Auth::user()->unreadNotifications()->count();
    }

    public function sortBy($sort): void
    {
        $this->tab = $this->validSort($sort) ? $sort : 'all';
    }
    public function validSort($sort): bool
    {
        return in_array($sort, [
            'all',
            'new_blog',
            'new_user'
        ]);
    }
    public function markAsRead(string $notificationId): void
    {
        $notification = DatabaseNotification::findOrFail($notificationId);

        $this->authorize(NotificationPolicy::MARK_AS_READ, $notification);

        $notification->markAsRead();

        $this->notificationCount--;

        $this->emit('NotificationMarkedAsRead', $this->notificationCount);
    }
    public function markAllAsRead(): void
    {

        // $this->authorize(NotificationPolicy::MARK_AS_READ, auth()->user()->unreadNotifications);

        auth()->user()->unreadNotifications->markAsRead();

        $this->notificationCount = 0;

        $this->emit('NotificationMarkedAsRead', $this->notificationCount);
    }
    public function delete(string $notificationId): void
    {
        $notification = DatabaseNotification::findOrFail($notificationId);

        $this->authorize(NotificationPolicy::MARK_AS_READ, $notification);
        $notification->delete();

        $this->notificationCount--;

        $this->emit('NotificationMarkedAsRead', $this->notificationCount);
    }
}
