<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallationController extends Controller
{
    public function install()
    {
        return view('installation.index');
    }
}
