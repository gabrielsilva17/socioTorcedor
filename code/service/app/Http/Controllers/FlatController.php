<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlatRequest;
use App\Services\FlatService;
use Illuminate\Http\Response;

class FlatController extends Controller
{
    /** @var FlatService $service */
    public $service;

    /**
     * FlatController constructor.
     * @param FlatService $service
     */
    public function __construct(FlatService $service)
    {
        $this->service = $service;
    }

    public function store(FlatRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, FlatRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
