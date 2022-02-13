<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function courses() {
        return view('courses');
    }

    //
    public function course(Request $request, $subdomain) {
        echo $subdomain;
    }


}
