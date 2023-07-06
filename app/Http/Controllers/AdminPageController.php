<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $url = (new Request)->path();
        $segments = explode('/', $url);

        // Get the value after "admin/"
        $posts = $segments[1];

        return view('admin.index');
    }
}
