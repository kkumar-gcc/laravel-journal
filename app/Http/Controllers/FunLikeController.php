<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFunLikeRequest;
use App\Http\Requests\UpdateFunLikeRequest;
use App\Models\FunLike;

class FunLikeController extends Controller
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
     * @param  \App\Http\Requests\StoreFunLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FunLike  $funLike
     * @return \Illuminate\Http\Response
     */
    public function show(FunLike $funLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FunLike  $funLike
     * @return \Illuminate\Http\Response
     */
    public function edit(FunLike $funLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunLikeRequest  $request
     * @param  \App\Models\FunLike  $funLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunLikeRequest $request, FunLike $funLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunLike  $funLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunLike $funLike)
    {
        //
    }
}
