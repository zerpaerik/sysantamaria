<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SidenavRouterController extends Controller
{
    public function getView (Request $request){
    	return view('generics.router');
    }

    public function getMov (Request $request){
    	return view('movimientos.index');
    }

    public function getLog (Request $request){
    	return view('generics.logview');
    }
}
