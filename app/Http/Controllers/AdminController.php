<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $links = [
                [
                    'href' => 'titlein',
                    'text' => 'link1',
                ],
                [
                    'href' => 'tasd',
                    'text' => 'link 2',
                ],
        ];

        return view('admin.index')->with('links', $links);
    }
}