<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gateway\GatewayUpdatePriorityRequest;
use App\Services\GatewayService;

class GatewayController extends Controller
{
    public function __construct(
        private GatewayService $gatewayService,
    ) {}

    public function toggleIsActive(int $id)
    {
        $this->gatewayService->toggleIsActive($id);

        return $this->success('Gateway updated');
    }

    public function updatePriority(int $id, GatewayUpdatePriorityRequest $request)
    {
        $data = $request->validated();

        $this->gatewayService->update($id, $data);

        return $this->success('Gateway updated');
    }
}
