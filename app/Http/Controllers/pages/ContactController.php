<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
        public function contact() {
        return view('pages.contact');
    }
}
