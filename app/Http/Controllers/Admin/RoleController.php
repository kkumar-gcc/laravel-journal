<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('access roles'))
        {
            abort(403);
        }

        return view('admin.roles.index');
    }
}
