<!--

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SynchronizeCsrfToken
{
    public function handle($request, Closure $next)
    {
        $xsrfToken = Cookie::get('XSRF-TOKEN');

        if (!$xsrfToken) {
            $xsrfToken = Str::random(40);
            Cookie::queue('XSRF-TOKEN', $xsrfToken, 120, '/', null, false, false);
        }

        // Set the CSRF token for the current session
        $request->session()->put('_token', $xsrfToken);

        // Verify the session token
        $sessionToken = $request->session()->get('_token');
        //dd($sessionToken);

        config(['session.token' => $xsrfToken]);
        return $next($request);
    }

}





