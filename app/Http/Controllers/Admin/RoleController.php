<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->hasRole(['admin'])) {
            return redirect('admin/dashboard');
        } elseif (auth()->user()->hasRole(['owner'])) {
            return redirect('owner/dashboard');
        } else {
            return redirect('/');
        }
    }
}
