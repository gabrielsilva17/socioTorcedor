<?php

namespace App\Http\Controllers;


use App\Http\Requests\AvailableRequest;
use App\Services\AvailableService;
use Illuminate\Http\Response;

class AvailableController extends Controller
{
    /** @var AvailableService $service */
    public $service;

    /**
     * FlatController constructor.
     * @param AvailableService $service
     */
    public function __construct(AvailableService $service)
    {
        $this->service = $service;
    }

    public function store(AvailableRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, AvailableRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
