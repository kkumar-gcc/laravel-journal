<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogLikeRequest;
use App\Http\Requests\UpdateBlogLikeRequest;
use App\Models\BlogLike;

class BlogLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreBlogLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function show(BlogLike $blogLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogLike $blogLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogLikeRequest  $request
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogLikeRequest $request, BlogLike $blogLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogLike $blogLike)
    {
        //
    }
}
