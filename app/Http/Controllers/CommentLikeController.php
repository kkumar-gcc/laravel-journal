<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentLikeRequest;
use App\Http\Requests\UpdateCommentLikeRequest;
use App\Models\CommentLike;

class CommentLikeController extends Controller
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
     * @param  \App\Http\Requests\StoreCommentLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function show(CommentLike $commentLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentLike $commentLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentLikeRequest  $request
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentLikeRequest $request, CommentLike $commentLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentLike $commentLike)
    {
        //
    }
}
