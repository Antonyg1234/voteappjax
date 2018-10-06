<?php

namespace App\Http\Middleware;

use App\Model\EventMaster;
use Closure;

class UploadUrlPrevention
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

        $email = session()->get('user_email');
        if ($email){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}