<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function about() 
    {
        return view('about');
      }
    
      public function contacts() 
      {
        return view('contacts');
      }
    
      public function welcome() 
      {
        return view('front');
      }
}
