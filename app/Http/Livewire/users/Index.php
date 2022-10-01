<?php

namespace App\Http\Livewire\users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    // public $tab = 'recent';

    // protected $queryString = [
    //     'tab' => ['except' => 'recent']
    // ];

    public function render()
    {
        // if ($this->validSort($this->tab)) {
        //    $users = User::paginate(10);
        // } else {
        //    $this->tab = 'recent';
        //    $users = User::paginate(10);
        // }
        $users = User::paginate(10);
        return view('livewire.users.index')->with(["users" => $users]);
    }
    // public function sortBy($sort): void
    // {
    //     $this->tab = $this->validSort($sort) ? $sort : 'recent';
    // }
    // public function validSort($sort): bool
    // {
    //     return in_array($sort, [
    //         'recent',
    //         'popular',
    //         'view'
    //     ]);
    // }

}
