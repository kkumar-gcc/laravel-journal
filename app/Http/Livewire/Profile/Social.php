<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Social extends Component
{
    public $twitterUrl;
    public $facebookUrl;
    public $linkedinUrl;
    public $stackoverflowUrl;
    public $redditUrl;
    public $instagramUrl;
    public $youtubeUrl;
    public $quoraUrl;
    public $laracastsUrl;
    public $githubUrl;
    public $mediumUrl;
    public $codepenUrl;
    protected $user;
    public function mount()
    {
        $this->user = auth()->user();
        $this->twitterUrl=$this->user->twitter_url;
        $this->facebookUrl=$this->user->facebook_url;
        $this->linkedinUrl=$this->user->linkedin_url;
        $this->stackoverflowUrl=$this->user->stackoverflow_url;
        $this->redditUrl=$this->user->reddit_url;
        $this->instagramUrl=$this->user->instagram_url;
        $this->youtubeUrl=$this->user->youtube_url;
        $this->quoraUrl=$this->user->quora_url;
        $this->laracastsUrl=$this->user->laracasts_url;
        $this->githubUrl=$this->user->github_url;
        $this->mediumUrl=$this->user->medium_url;
        $this->codepenUrl=$this->user->codepen_url;
    }

    public function render()
    {

        return view('livewire.profile.social');

    }
    public function social(){
        $user = User::find(auth()->user()->id);
        $user->twitter_url = $this->twitterUrl;
        $user->facebook_url = $this->facebookUrl;
        $user->linkedin_url = $this->linkedinUrl;
        $user->stackoverflow_url = $this->stackoverflowUrl;
        $user->reddit_url = $this->redditUrl;
        $user->instagram_url = $this->instagramUrl;
        $user->youtube_url = $this->youtubeUrl;
        $user->quora_url = $this->quoraUrl;
        $user->laracasts_url = $this->laracastsUrl;
        $user->github_url = $this->githubUrl;
        $user->medium_url =$this->mediumUrl;
        $user->codepen_url = $this->codepenUrl;
        $saved = $user->save();
        if ($saved) {
            $this->emit('changed');
            session()->flash('message', 'Social info updated successfully');
        }
    }
}
