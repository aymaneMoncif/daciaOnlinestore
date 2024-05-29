<!--
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CustomVerifyCsrfToken extends BaseVerifier
{
    protected function tokensMatch($request)
    {
        $token = $request->session()->token();

        //dd($token);
        // Ensure the token matches with the cookie value
        $xsrfToken = Cookie::get('XSRF-TOKEN');

        if ($xsrfToken && $xsrfToken !== $token) {
            $request->session()->put('_token', $xsrfToken);
            $token = $xsrfToken;
        }

        return parent::tokensMatch($request);
    }
}
-->
