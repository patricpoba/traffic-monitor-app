@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card"> 

                <div class="card-body"> 
  
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">IP</th>   
                                    
                                    <th scope="col">DETAILS</th>   

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($httpRequests as $httpRequest)

                                    <tr>
                                        <th scope="row">{{ $httpRequest->id }}</th>

                                        <td>
                                            {{ $httpRequest->ip }} <br />
                                            <sup title="{{ $httpRequest->created_at }}">{{ $httpRequest->created_at->format('M d Y, g:i A') }}</sup>
                                        </td>

                                        <td>
                                            {{ $httpRequest->url }}
                                            <br />
                                            <sup>{{ $httpRequest->user_agent }}</sup>
                                        </td>  
                                    </tr>

                                @endforeach 
 
                            </tbody>
                        </table>

                        {{ $httpRequests->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection