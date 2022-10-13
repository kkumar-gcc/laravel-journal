<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('access permissions'))
        {
            abort(403);
        }
        return view('admin.permissions.index');
    }
}
