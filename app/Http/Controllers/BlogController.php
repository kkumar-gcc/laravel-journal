<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\BlogView;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("blogs.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $last_draft = Blog::where([['user_id', auth()->user()->id], ['status', "drafted"]])->OrderBy('updated_at', 'desc')->first();
            $tagTitles = [];
            if ($last_draft) {
                foreach ($last_draft->tags as $tag) {
                    $tagTitles[] = $tag->title;
                }
            }
            $isDraftNull = 0;
            if ($last_draft) {
                $isDraftNull = 1;
            }
            return view("blogs.create")
                ->with(["draft" => $last_draft, "tagTitles" => json_encode($tagTitles), "isDraftNull" => $isDraftNull]);
        } else {
            return view("auth.login")->with(["warning" => "You must be logged in to create Blog."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function draft(Request $request)
    {

        $blogId = $request->get('blogId');
        $blogTitle = $request->get('blogTitle');
        $blogDescription = $request->get('blogDescription');
        $tagNames = json_decode($request->get('tags'));

        if ($blogId != '') {

            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $tagIds = [];
            $tagTitles = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                    $tagTitles[] = $tag->title;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);
        } else {
            $blog = new Blog();
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "drafted";
            $blog->user_id = auth()->user()->id;
            $tagIds = [];
            $tagTitles = [];
            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                    $tagTitles[] = $tag->title;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);

            $blogId = $blog->id;
        }

        return response()->json([
            "success" => 'post created successfully',
            "blogId" => $blogId,
            "tagTitles" => $request->get('tags')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        if ($blog) {
            if ($blog->status == "posted") {
                // $shareBlog =  ShareFacade::page(
                //     URL::current(),
                //     $blog->title,
                // )
                //     ->facebook()
                //     ->twitter()
                //     ->linkedin()
                //     ->telegram()
                //     ->whatsapp()
                //     ->reddit()
                //     ->getRawLinks();
                //    dd($blog->body());


                $existView = BlogView::where([['ip_address', "=", $request->ip()], ["blog_id", "=", $blog->id]])->count();
                if ($existView < 1) {
                    $newView = new BlogView();
                    $newView->ip_address = $request->ip();
                    $newView->blog_id = $blog->id;
                    $newView->save();
                }
                $related = Blog::where("status", "=", "posted")->with(['user', 'tags', 'bloglikes', 'blogviews'])->whereHas('tags', function ($query) use ($blog) {
                    $query->whereIn('title', $blog->tags->pluck('title'));
                }, '>=', count($blog->tags->pluck('title')))->where("id", "!=", $blog->id)->limit(5)->withCount('tags')
                    ->get();
                return view("blogs.show")->with([
                    "blog" => $blog,
                    "related" => $related,
                ]);
            }
        }
        return abort(404);;
    }
    public function edit($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->Authorize('view', $blog);
        if ($blog) {
            return view("blogs.update")->with(["blog" => $blog]);
        }
    }

    public function manage($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->Authorize('update', $blog);
        if ($blog) {
            return view("blogs.manage")->with([
                "blog" => $blog,
            ]);
        }
        return abort(404);
    }
    public function seo(Request $request)
    {

        if (auth()->user()->id == $request->get('user_id')) {
            $blogId = $request->get('blog_id');
            $blog = Blog::find($blogId);
            if ($blog) {
                if ($request->get('user_id') == auth()->user()->id) {
                    $blog->meta_title = $request->get('seo_title');
                    $blog->meta_description = $request->get('seo_description');
                    $saved = $blog->save();
                    return response()->json(["success" => "SEO settings updated successfully."]);
                }
            }
        }
        return view("error");
    }
    public function stats($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->Authorize('update', $blog);
        if ($blog) {
            return view("blogs.stats")->with([
                "blog" => $blog,
            ]);
        }
        return abort(404);
    }
    public function manageStore(Request $request)
    {
        if (auth()->user()->id == $request->get('user_id')) {
            $blogId = $request->get('blog_id');
            $blog = Blog::find($blogId);
            if ($blog) {
                if ($request->get('user_id') == auth()->user()->id) {
                    $blog->access = $request->get('blog_access');
                    $blog->comment_access = $request->get('comment_access');
                    $blog->adult_warning = $request->boolean('adult_warning');
                    $blog->age_confirmation  = $request->boolean('age_confirmation');
                    $saved = $blog->save();
                    return response()->json(["success" => "Blog updated successfully."]);
                }
            }
        }
        return view("404");
    }
    public function tagSearch(Request $request, $slug)
    {
        $searchTag = Tag::where("title", "=", $slug)->first();
        return view("blogs.tagged")->with([
            "searchTag" => $searchTag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (auth()->user()->id == $request->get('user_id')) {
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return redirect('/blogs')->with(["deleteSuccess" => "blog deleted successfully."]);
        }
        return view('error');
    }
}
