<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\GatewayApiException;
use App\Repositories\Gateway\GatewayRepositoryInterface;
use App\Services\GatewayApi\GatewayApiInterface;

class GatewayService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected GatewayRepositoryInterface $repository)
    {}

    public function toggleIsActive(int|string $id): void
    {
        $gateway = $this->findById($id);

        $this->repository->update($id, [
            'is_active' => !$gateway['is_active'],
        ]);
    }

    public function getInstanceOfGatewayByName(string $gatewayName): GatewayApiInterface
    {
        $gatewayApi = config("gateways.{$gatewayName}");

        if (!$gatewayApi && class_exists($gatewayApi)) throw new GatewayApiException("We were unable to find an instance of the gateway: {$gatewayName}, please add it to the config/gateways.php file.");

        return new $gatewayApi();
    }
}
