<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('ShowString2');
    }
    public function ShowString(){
        return 'Show Second Controller';
    }
    public function ShowString2(){
        return 'Show Second Controller2';
    }
    public function ShowString3(){
        return 'Show Second Controller3';
    }
    public function ShowString4(){
        return 'Show Second Controller4';
    }
}
