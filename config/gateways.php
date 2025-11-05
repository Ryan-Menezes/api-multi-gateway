<?php

use App\Services\GatewayApi\Gateway1GatewayApi;
use App\Services\GatewayApi\Gateway2GatewayApi;

return [
    'gateway-1' => new Gateway1GatewayApi(),
    'gateway-2' => new Gateway2GatewayApi(),
];
