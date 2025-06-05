<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class OutgoingController extends Controller
{
    public function index(){
        return view('outgoings.index');
    }

    public function create(){
        return view('outgoings.create');
    }

    // 
    public function developer(){
        return view('outgoings.developer');
    }



}
