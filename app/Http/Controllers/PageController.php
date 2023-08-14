<?php

namespace App\Http\Controllers;

use Wave\Http\Controllers\PageController as BaseController;
use Wave\Page;

class PageController extends BaseController
{
    public function page($slug){
        $page = Page::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $page->title,
            'seo_description' => $page->meta_description,
        ];

        return view('theme::page', compact('page', 'seo'));
    }
}
