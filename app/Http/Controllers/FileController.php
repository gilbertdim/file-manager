<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function shared()
    {
        return Inertia::render('Dashboard');
    }

    public function trash()
    {
        return Inertia::render('Dashboard');
    }
}
