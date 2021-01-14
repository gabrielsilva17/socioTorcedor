<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Constants\Messages;
use App\Services\Service;
use App\Traits\ResponseTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseTrait;

    /** @var Service $service */
    public $service;

    /**
     * @param string|null $jwt
     * @param Request|null $request
     * @param string $header
     * @return mixed|null
     */
    public function getJWTPayload(string $jwt = null, Request $request = null, string $header = 'Authorization')
    {
        $request = $request ?? app(Request::class);
        $jwt = $jwt ?: $request->header($header);

        $payloadEncoded = explode('.', $jwt);
        $payloadString = count($payloadEncoded) === 3 ? base64_decode($payloadEncoded[1]) : null;
        return $payloadString ? json_decode($payloadString, true) : null;
    }

    public function index(Request $request)
    {
        $headers = $this->getJWTPayload();
        $request[Constants::CD_UUID_ACCOUNT] = isset($headers[Constants::ARRAY_DATA][Constants::ARRAY_ACCOUNT]) ?
            $headers[Constants::ACCOUNT_SUB] :
            $request[Constants::CD_UUID_ACCOUNT];
        return $this->sendResponse($this->service->getPaginate($request->all()), Messages::MSG029);
    }

    public function show($id)
    {
        return $this->sendResponse($this->service->find($id), Messages::MSG029);
    }

    public function destroy($id)
    {
        return $this->sendResponse($this->service->delete($id), Messages::MSG029);
    }

}
