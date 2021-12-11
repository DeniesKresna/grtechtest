<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Helper;
use Curl;

class QuoteController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dataTable(collect(json_decode($this->getQuotes())));
        }
        
        return view('contents.quote.index',['pageTitle'=>'Quote','rootMenu'=>'Page','subMenu'=>'Quote']);
    }

    public function getQuotes() {
        return Curl::to('https://zenquotes.io/api/quotes')->get();
    }
}
