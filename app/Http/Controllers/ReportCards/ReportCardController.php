<?php

namespace App\Http\Controllers\ReportCards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportCardController extends Controller
{
    public function index(){

        return view('report_cards.list');
    }

    public function create(){

        return view('report_cards.create');
    }

    public function store(){

    }

    public function edit(){

        return view('report_cards.edit');
    }

    public function update(){

    }

    public function delete(){
        //
    }
}
