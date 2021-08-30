<?php

namespace OpenJournalTeam\Core\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use Illuminate\Support\Facades\Http;
use OpenJournalTeam\Core\Classes\KeyManager;
use OpenJournalTeam\Master\Models\Customer;
use OpenJournalTeam\Master\Models\CustomerHosting;

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
    public function registerCustomerUser(Request $request, Customer $customer, CustomerHosting $customerHosting)
    {

        if ($request->ajax()) {
            $password   = KeyManager::decryptWithPublicKey($customer->password);
            $url        = sprintf("http://%s:9494/register", $customerHosting->server->ip);

            $payLoad = [
                'name'          => $customer->name,
                'email'         => $customer->email,
                'password'      => $password,
                'dir'           => $customerHosting->directory,
                'domain'        => $customerHosting->domain_name,
                'storage_limit' => 1
            ];

            $doRequest = Http::post($url, $payLoad);
            $response  = $doRequest->object();

            $json['error'] = $response->error;
            $json['msg']   = $response->msg;

            return response()->json(new JsonResponse($json));
        }
    }
}
