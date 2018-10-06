<?php

namespace App\Http\Middleware;

use App\Model\EventMaster;
use Carbon\Carbon;
use Closure;

class PreventRegisterUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->event_id){
            $event = EventMaster::select('event_date')->where('id',$request->event_id)->first();

        }else{
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $event_id = $uri_segments[2];
            $event = EventMaster::select('event_date')->where('id',$event_id)->first();
        }

        if (Carbon::now()->format('Y-m-d h:i:s') <  $event['event_date']){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}