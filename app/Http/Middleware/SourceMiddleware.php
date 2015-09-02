<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SourceMiddleware
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

        if($this->isMobile() != 0 || $this->isFacebook()){
            return $next($request);
        }
        return redirect('desktop');
    }


    public function isMobile(){
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    public function isFacebook(){
        if (in_array($_SERVER['HTTP_USER_AGENT'], array( 'facebookexternalhit/1.0 (+https://www.facebook.com/externalhit_uatext.php)', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'Facebot (+http://www.facebook.com/externalhit_uatext.php)' ))) {
            return true;
        }
        return false;

    }



}
