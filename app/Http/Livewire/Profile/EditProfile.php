<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class EditProfile extends Component
{
    public $username;
    public $name;
    public $location;
    public $firstName;
    public $lastName;
    public $shortBio;
    public $aboutMe;
    public $websiteUrl;
    public function mount()
    {
        $user = auth()->user();
        $this->username = $user->username();
        $this->name = $user->name;
        $this->location = $user->location();
        $this->firstName = $user->firstName();
        $this->lastName = $user->lastName();
        $this->shortBio = $user->shortBio();
        $this->aboutMe = $user->aboutMe();
        $this->websiteUrl = $user->websiteUrl();
    }
    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
    protected $rules = [
        // "profile_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
        //     "background_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
        "username" => 'required',
        "shortBio" => "required|min:20|max:300"

    ];
    public function update()
    {
        $this->validate();
        $user = User::find(auth()->user()->id);
        // if ($request->hasFile('profile_image')) {
        //     $profileImage = $this->uploads($request->file('profile_image'));
        //     $user->profile_image = $profileImage['filePath'];
        // }
        // if ($request->hasFile('background_image')) {
        //     $backgroundImage = $this->uploads($request->file('background_image'));
        //     $user->background_image = $backgroundImage['filePath'];
        // }
        $user->name = $this->name;
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->about_me = $this->aboutMe;
        $user->short_bio = $this->shortBio;
        $user->portfolio_url = $this->websiteUrl;
        $saved = $user->save();
        if ($saved) {
            $this->emit('changed');
            session()->flash('message', 'profile updated successfully');
        }
    }
}
