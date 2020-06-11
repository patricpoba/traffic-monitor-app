<?php

namespace App\Http\Middleware;

use Closure;
use App\HttpRequest;
use Jenssegers\Agent\Agent; 

class LogHttpRequestMiddleware
{
    /**
     * The request fields to obfuscate.
     *
     * @var array
     */
    protected $coverFields = [
        'secret',
        'password',
        'current_password',
        'password_confirmation',
    ];

    /**
     * The urls that should be excluded from logging. Url may be
     * prefixed with the particular status. Eg
     * '/webhooks/utils/mtn-scraper' or '200:/webhooks/utils/mtn-scraper' or
     * @var array
     */
    protected $exemptedPaths = [ 
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Perform any final actions for the request lifecycle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        if ($this->isExemptedFromLogging($request, $response)) {
            return ;
        }
  
        $location = $this->getGeoLocationOfIP($request->ip());

        $data = [
            'user_agent'            => $request->headers->get('user-agent'),

            'user_agent_explanation'=> $this->getAgent(),

            'url'                   => $request->fullUrl(),

            'request'               =>  json_encode($request->all()),

            'response'              => $response,

            'ip'                    => $request->ip(),

            'headers'               => json_encode($request->header()), 

            'referral_url'          => $request->headers->get('referer') ,

            'location'              => $location
        ];
  
        HttpRequest::create($data);
    }

    protected function getGeoLocationOfIP($ip)
    {
        return 
        \Cache::remember('key', 6000, function () use ($ip) {
            
            try { 
                $geoLocation = file_get_contents("http://ip-api.com/json/$ip");  
    
            } catch (\Exception $exception) {
    
                logger()->debug($exception->getMessage());
                $geoLocation = null;
            } 
            return $geoLocation;
        });
    }

    /**
     * Get the user's browser and OS.
     *
     * @return string The user's browser and OS
     */
    protected function getAgent(): string
    {
        //create new agent instance
        $agent = new Agent();

        //check if agent is robot
        if ($agent->isRobot()) {
            return $agent->robot();
        }

        //if agent is not robot then get agent browser and platform like Chrome in Linux
        // $agent = $agent->browser() . " in " . $agent->platform() ;
        $agent = json_encode([
            'device'    => $agent->device(),
            'platform'  => $agent->platform(),
            'browser'   => $agent->browser()
        ]); 
        
        return $agent;
    }
  

    /**
     * Check if request can be logged or not.
     *
     * @param [type] $request
     * @param [type] $response
     * @return boolean
     */
    protected function isExemptedFromLogging($request, $response)
    {
        return in_array($request->getPathInfo(), $this->exemptedPaths)
            
            || in_array($response->getStatusCode() . ':' . $request->getPathInfo(), $this->exemptedPaths);
    }
}
