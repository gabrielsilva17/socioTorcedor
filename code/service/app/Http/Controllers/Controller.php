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

    public function index(Request $request)
    {
        return $this->sendResponse($this->service->getPaginate($request->all()), __('responses.success.list'));
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
