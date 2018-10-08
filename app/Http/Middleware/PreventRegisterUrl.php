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
        $event = EventMaster::select('event_date')->where('id',$request->register)->first();
        if (Carbon::now()->format('Y-m-d h:i:s') <  $event['event_date']){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}