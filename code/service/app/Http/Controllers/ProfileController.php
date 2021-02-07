<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /** @var ProfileService $service */
    public $service;

    /**
     * ProfileController constructor.
     * @param ProfileService $service
     */
    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function store(ProfileRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all()),
            __('responses.success.create'),
            Response::HTTP_CREATED
        );
    }

    public function update($id, ProfileRequest $request)
    {
        return $this->sendResponse(
            $this->service->save($request->all(), $id),
            __('responses.success.update'),
            Response::HTTP_CREATED
        );
    }


}
