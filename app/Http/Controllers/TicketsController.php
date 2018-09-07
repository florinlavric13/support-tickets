<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class TicketsController extends Controller
{
    public  function create() {

        $categories = Category::all();
        $view = view('tickets.create', compact('categories'));

        return $view;
    }
}
