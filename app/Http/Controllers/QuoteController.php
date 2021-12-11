<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //return response()->json(json_decode($this->getQuotes()));
            return $this->dataTable($this->getQuotes());
        }
        
        return view('contents.quote.index',['pageTitle'=>'Quote','rootMenu'=>'Page','subMenu'=>'Quote']);
    }

    public function getQuotes() {
        return Curl::to('https://zenquotes.io/api/quotes')->get();
    }
}
