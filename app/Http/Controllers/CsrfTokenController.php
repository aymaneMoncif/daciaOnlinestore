<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsrfTokenController extends Controller
{
    public function getCsrfToken()
    {
        return response()->json([
            'csrfToken' => csrf_token(),
        ]);
    }
}
