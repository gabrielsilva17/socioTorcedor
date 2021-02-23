<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrequencyRequest;
use App\Services\FrequencyService;
use Illuminate\Http\Response;

class FlatController extends Controller
{
    /** @var FrequencyService $service */
    public $service;

    /**
     * FlatController constructor.
     * @param FrequencyService $service
     */
    public function __construct(FrequencyService $service)
    {
        $this->service = $service;
    }

    public function store(FrequencyRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, FrequencyRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
