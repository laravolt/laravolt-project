<?php

namespace Laravolt\Collab\Http\Controllers;

use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        return view('collab::projects.index');
    }
}
