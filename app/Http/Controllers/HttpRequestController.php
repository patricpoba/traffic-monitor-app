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
        $viewData['httpRequests'] = HttpRequest::latest('id')->paginate($request->pageSize ?? 50);
        
        if ($request->has('from_date') && $request->has('to_date')) {
            
            $request->merge([
                'from'  => $request->from_date .' '. $request->from_time,
                'to'    => $request->to_date   .' '. $request->to_time
            ]);
        
            $viewData['uniqueIpsCount'] = HttpRequest::groupBy('ip')
                ->whereBetween('created_at', [ $request->from, $request->to])
                ->count();

            $viewData['urlVisistCount'] = HttpRequest::selectRaw('url, count(url) as url_visit_count')
                ->whereBetween('created_at', [ $request->from, $request->to]) 
                ->groupBy('url')
                ->get();

            $viewData['totalVisits'] = HttpRequest::whereBetween('created_at', [ $request->from, $request->to])
                    ->count();
        }
 
        return view('http-requests.index', $viewData );
    }


}
