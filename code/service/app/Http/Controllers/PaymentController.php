<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /** @var PaymentService $service */
    public $service;

    /**
     * FlatController constructor.
     * @param PaymentService $service
     */
    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    public function store(PaymentRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, PaymentRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
