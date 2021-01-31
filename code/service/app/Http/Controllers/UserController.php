<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /** @var UserService $service */
    public $service;

    /**
     * PerfilController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(UserRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, UserRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
