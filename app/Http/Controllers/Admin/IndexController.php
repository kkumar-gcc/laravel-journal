<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function users()
    {
        if (!auth()->user()->can('access users'))
        {
            abort(403);
        }
        return view('admin.users.index');
    }
    public function tags()
    {
        if (!auth()->user()->can('access tags'))
        {
            abort(403);
        }
        return view('admin.tags.index');
    }
}
