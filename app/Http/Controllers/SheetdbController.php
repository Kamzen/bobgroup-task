<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Http;
use SheetDB\SheetDB;


class SheetdbController extends Controller
{
    //
    public function get(){


        $dataFromSheet = new SheetDB('vfego5gjhptkm');

        return view('sticker', ['data' => json_encode($dataFromSheet->get())]);


    }
}
