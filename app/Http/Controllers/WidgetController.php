<?php

namespace App\Http\Controllers;

class WidgetController extends Controller
{
    public function widget()
    {
        return view('widget');
    }

    public function viewWidget()
    {
        return view('view-widget');
    }
}
