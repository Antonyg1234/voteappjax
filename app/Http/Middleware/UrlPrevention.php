<?php

namespace App\Http\Middleware;

use App\Model\EventMaster;
use Closure;

class UrlPrevention
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
        $voting_end_date = EventMaster::select('voting_end_date')->where('id',$request->id)->first();
        $date = $voting_end_date->toArray();
        if (!$date['voting_end_date']['smaller']){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}