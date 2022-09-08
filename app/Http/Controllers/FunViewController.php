<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFunViewRequest;
use App\Http\Requests\UpdateFunViewRequest;
use App\Models\FunView;

class FunViewController extends Controller
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
     * @param  \App\Http\Requests\StoreFunViewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FunView  $funView
     * @return \Illuminate\Http\Response
     */
    public function show(FunView $funView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FunView  $funView
     * @return \Illuminate\Http\Response
     */
    public function edit(FunView $funView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunViewRequest  $request
     * @param  \App\Models\FunView  $funView
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunViewRequest $request, FunView $funView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunView  $funView
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunView $funView)
    {
        //
    }
}
