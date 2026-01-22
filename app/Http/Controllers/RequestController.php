<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    /**
     * Show success page
     */
    public function success($tracking_id)
    {
        $request = Request::where('tracking_id', $tracking_id)->firstOrFail();
        return view('request.success', compact('request'));
    }
}

