<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] =  'The Home Page';
        //$title = 'Project | About Us';
        return view('home.index', $data);
    }

    public function about()
    {
        $data['title'] =  'The  About Page';
       
        return view('home.about', $data);
    }


}
