<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Bookmark;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BlogPin;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PrivateProfileController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tab = "profile";
        $user = User::find(auth()->user()->id);
        if ($request->tab == 'profile') {
            $tab = 'profile';
            return view("profile.private.index")->with([
                "user" => $user,
                "tab" => $tab
            ]);
        } else if ($request->tab == "password") {
            $tab = 'password';
            return view("profile.private.index")->with([
                "user" =>  $user,
                "tab" => $tab
            ]);
        } else if ($request->tab == "social_links") {
            $tab = 'social_links';
            return view("profile.private.index")->with([
                "user" => $user,
                "tab" => $tab
            ]);
        } else if ($request->tab == "blogs") {
            $tab = 'blogs';
            $blogs = Blog::where("user_id", "=", auth()->user()->id)->where('status', '=', 'posted')->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "blogs" => $blogs,
                "tab" => $tab
            ]);
        } else if ($request->tab == "drafts") {
            $tab = 'drafts';
            $drafts = Blog::where("user_id", "=", auth()->user()->id)->where('status', '=', 'drafted')->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "drafts" => $drafts,
                "tab" => $tab
            ]);
        } else if ($request->tab == 'bookmarks') {
            $tab = 'bookmarks';
            $bookmarks = Bookmark::where("user_id", "=", auth()->user()->id)->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "bookmarks" => $bookmarks,
                "tab" => $tab
            ]);
        } else if ($request->tab == 'follower') {
            $tab = 'follower';
            $subscribers =$user->subscribers()->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "followers" => $subscribers,
                "tab" => $tab
            ]);
        } else if ($request->tab == 'following') {
            $tab = 'following';
            $followings = $user->followings()->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "followings" => $followings,
                "tab" => $tab
            ]);
        } else if ($request->tab == 'pins') {
            $tab = 'pins';return view("profile.private.index")->with([
                "user" =>  $user,
                "tab" => $tab,
            ]);
        } else if ($request->tab == 'comments') {
            $tab = 'comments';
            $comments = Comment::where('user_id', '=', Auth()->user()->id)->get();
            // ->paginate(5);
            return view("profile.private.index")->with([
                "user" =>  $user,
                "comments" => $comments,
                "tab" => $tab
            ]);
        } else if ($request->tab == "about") {
            $tab = "about";
            return view("profile.private.index")->with([
                "user" =>  $user,
                "tab" => $tab
            ]);
        } else {
            return view("profile.private.index")->with([
                "user" =>  $user,
                "tab" => $tab
            ]);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function draft($id)
    {
        if (Auth::check()) {
            $draft = Blog::where([['id', $id], ['status', "drafted"], ["user_id", auth()->user()->id]])->first();
            if ($draft->count() > 0) {
                $tagTitles = [];
                if ($draft) {
                    foreach ($draft->tags as $tag) {
                        $tagTitles[] = $tag->title;
                    }
                }
                $isDraftNull = 0;
                if ($draft) {
                    $isDraftNull = 1;
                }
                return view("blogs.draft")
                    ->with(["draft" => $draft, "tagTitles" => json_encode($tagTitles), "isDraftNull" => $isDraftNull]);
            }
        } else {
            return view("auth.login")->with(["warning" => "You must be logged in to create Blog."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "profile_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "background_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "username" => 'required',
            "short_bio" => "required|min:20|max:300"
        ]);
        if (auth()->user()->id == $request->get('user_id')) {
            $user = User::find(auth()->user()->id);
            if ($request->hasFile('profile_image')) {
                $profileImage = $this->uploads($request->file('profile_image'));
                $user->profile_image = $profileImage['filePath'];
            }
            if ($request->hasFile('background_image')) {
                $backgroundImage = $this->uploads($request->file('background_image'));
                $user->background_image = $backgroundImage['filePath'];
            }
            $user->name = $request->get('name');
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->about_me = $request->get('about_me');
            $user->short_bio = $request->get('short_bio');
            $user->portfolio_url = $request->get('website_url');
            $user->twitter_url = $request->get('twitter_url');
            $user->github_url = $request->get('github_url');
            $user->facebook_url = $request->get('facebook_url');
            $saved = $user->save();
            if ($saved) {
                return response()->json(["success" => "profile updated successfully"]);
            }
        }
    }
    public function social(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->twitter_url = $request->get('twitter_username');
        $user->facebook_url = $request->get('facebook_username');
        $user->linkedin_url = $request->get('linkedin_username');
        $user->stackoverflow_url = $request->get('stackoverflow_username');
        $user->reddit_url = $request->get('reddit_username');
        $user->instagram_url = $request->get('instagram_username');
        $user->youtube_url = $request->get('youtube_channel');
        $user->quora_url = $request->get('quora_username');
        $user->laracasts_url = $request->get('laracasts_username');
        $user->github_url = $request->get('github_username');
        $user->medium_url = $request->get('medium_username');
        $user->codepen_url = $request->get('codepen_username');
        $saved = $user->save();
        if($saved){
            return redirect()->back()->with(['success'=>'social links updated successfully.']);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReplyRequest  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
