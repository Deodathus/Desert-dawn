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
                    'text' => '<i v-html="rawHtml" class="fas fa-users"></i> Users',
                ],
                [
                    'href' => 'tasd',
                    'text' => '<i class="fas fa-khanda"></i> Bosses',
                ],
        ];

        return view('admin.index')->with('links', $links);
    }
}