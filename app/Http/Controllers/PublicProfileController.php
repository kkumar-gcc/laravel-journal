<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogPin;
use App\Models\Bookmark;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $username)
    {
        $user = User::where("username", "=", $username)->first();
        if ($user) {
            $id = $user->id;
            $tab = "about";
            if ($request->tab == 'blogs') {
                $tab = 'blogs';
                $pins = BlogPin::where("user_id", "=", $id)->get();
                $blogs = Blog::with('user','tags')->where([["user_id", "=", $id],["is_pinned", "=", false]])->published()->paginate(5);
                return view("profile.public.index")->with([
                    "user" => $user,
                    "pins" => $pins,
                    "blogs" => $blogs,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'bookmarks') {
                $tab = 'bookmarks';
                $bookmarks = Bookmark::where("user_id", "=", $id)->paginate(5);
                return view("profile.public.index")->with([
                    "user" => $user,
                    "bookmarks" => $bookmarks,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'activity') {
                $tab = 'activity';
                return view("profile.public.index")->with([
                    "user" => $user,
                    "tab" => $tab
                ]);
            } else if ($request->tab == "about") {
                $tab = "about";
                return view("profile.public.index")->with([
                    "user" => $user,
                    "tab" => $tab
                ]);
            } else {
                return view("profile.public.index")->with([
                    "user" => $user,
                    "tab" => $tab
                ]);
            }
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
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
