<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Services\ClubService;
use Illuminate\Http\Response;

class ClubController extends Controller
{
    /** @var ClubService $service */
    public $service;

    /**
     * ClubController constructor.
     * @param ClubService $service
     */
    public function __construct(ClubService $service)
    {
        $this->service = $service;
    }

    public function store(ClubRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, ClubRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
