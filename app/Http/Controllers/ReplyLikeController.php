<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyLikeRequest;
use App\Http\Requests\UpdateReplyLikeRequest;
use App\Models\ReplyLike;

class ReplyLikeController extends Controller
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
     * @param  \App\Http\Requests\StoreReplyLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function show(ReplyLike $replyLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function edit(ReplyLike $replyLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReplyLikeRequest  $request
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyLikeRequest $request, ReplyLike $replyLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReplyLike $replyLike)
    {
        //
    }
}
