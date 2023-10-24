<?php

namespace App\Http\Controllers;

use App\Models\Changelogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangelogsController extends Controller
{
    public function index()
    {
        return view('changelogs.index');
    }
}
