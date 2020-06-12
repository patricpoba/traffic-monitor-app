@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body"> 
                    <form method="GET">
                        <div class="row">
                            <div class="col">
                                <input type="date" class="form-control" name="from_date" placeholder="from date" id="from_date" 
                                    value="{{ request()->from_date ?? now()->format('Y-m-d') }}">

                                <input type="time" class="form-control" name="from_time" placeholder="to date" 
                                    value="{{ request()->from_time ?? now()->format('H:i') }}">
                            </div>

                            <div class="col">
                                <input type="date" class="form-control" name="to_date" placeholder="to date" 
                                    value="{{ request()->to_date ?? now()->format('Y-m-d') }}">

                                <input type="time" class="form-control" name="to_time" placeholder="to date" 
                                    value="{{ request()->to_time ?? now()->format('H:i') }}">
                            </div>

                            <div class="col">
                                <input type="submit" class="btn btn-primary form-control" placeholder="Last name" value="filter">
                            </div>    
                            <div class="col">
                                <a href="{{ request()->url() }}" class="btn btn-default"> reset</a>
                            </div>

                        </div>
                    </form>

                    @if(isset($totalVisits) && isset($urlVisistCount) )
                        <hr />
                        <small>Total Visits: {{ $totalVisits }} Unique IPs : {{ $uniqueIpsCount }}</small>  <br />

                        @foreach($urlVisistCount as $urlVisit)
                            <small>{{ $urlVisit->url_visit_count }} visit @ {{ $urlVisit->url }} </small> <br />
                        @endforeach 
                    @endif
                </div>
            </div>

            <div class="card mt-4"> 

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
                                            {{ $httpRequest->ip }} 

                                            <?php $geoData = optional( json_decode($httpRequest->location) ); ?>
                                            <br /> <sup>{{ $geoData->country }},  {{ $geoData->regionName }}. ISP: {{ $geoData->isp }}</sup> 
                                            <br /><sup title="{{ $httpRequest->created_at }}">{{ $httpRequest->created_at->format('M d Y, g:i A') }}</sup>
                                        </td>

                                        <td>
                                            {{ $httpRequest->url }}
                                            <br /><sup>{{ $httpRequest->user_agent }}</sup>
                                            <br /><sup>{{ $httpRequest->user_agent_explanation }}</sup>
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