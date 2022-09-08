<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPinRequest;
use App\Http\Requests\UpdateBlogPinRequest;
use App\Models\BlogPin;

class BlogPinController extends Controller
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
     * @param  \App\Http\Requests\StoreBlogPinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPin $blogPin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPin $blogPin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogPinRequest  $request
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogPinRequest $request, BlogPin $blogPin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPin $blogPin)
    {
        //
    }
}
