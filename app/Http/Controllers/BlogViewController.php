<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogViewRequest;
use App\Http\Requests\UpdateBlogViewRequest;
use App\Models\BlogView;

class BlogViewController extends Controller
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
     * @param  \App\Http\Requests\StoreBlogViewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogView  $blogView
     * @return \Illuminate\Http\Response
     */
    public function show(BlogView $blogView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogView  $blogView
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogView $blogView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogViewRequest  $request
     * @param  \App\Models\BlogView  $blogView
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogViewRequest $request, BlogView $blogView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogView  $blogView
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogView $blogView)
    {
        //
    }
}
