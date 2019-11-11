<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $mainLinks = [
            [
                'name' => 'MainLink One'
            ],
            [
                'name' => 'MainLink Two',
            ],
        ];

        return view('admin.index');
    }
}