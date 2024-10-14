<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function nostarifs()
    {
        return view('frontend.nostarifs');
    }

    public function demandeinscription()
    {
        return view('frontend.demandeinscription');
    }

    public function apropos()
    {
        return view('admin.apropos');
    }

    public function aideconfidentialite()
    {
        return view('admin.aide&confidentialite');
    }
}
