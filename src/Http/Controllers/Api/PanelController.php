<?php

namespace OpenJournalTeam\Core\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use Illuminate\Support\Facades\Http;

/**
 * return json
 * return response()->json(new JsonResponse($json));
 * $url = "http://127.0.0.1:9494/register";
 * $payLoad = ['name' => '','email' => '','password' => ''];
 * $x = Http::post($url, $payLoad);
 * dd($x->object()->data);
 * 
 */
class PanelController extends Controller
{
    public function registerCustomerUser(Request $request)
    {


        $url = "http://127.0.0.1:9494/register";

        $payLoad = [
            'name'          => '',
            'email'         => '',
            'password'      => '',
            'dir'           => '',
            'domain'        => '',
            'storage_limit' => ''
        ];

        $doRequest = Http::post($url, $payLoad);
        $response  = $doRequest->object();
        dd($response);
    }
}
