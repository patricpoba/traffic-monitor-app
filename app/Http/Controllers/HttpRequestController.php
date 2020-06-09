<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;

class HttpRequestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $httpRequests = HttpRequest::paginate($request->pageSize ?? 50);

        return view('http-requests.index', compact('httpRequests') );
    }
}
