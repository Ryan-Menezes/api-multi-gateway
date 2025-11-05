<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TransactionStatusEnum;
use App\Exceptions\GatewayApiException;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TransactionService implements ServiceInterface
{
    use BaseService;

    public function __construct(
        protected TransactionRepositoryInterface $repository,
        private GatewayService $gatewayService,
    ) {}

    public function refund(int|string $id): void
    {
        $transaction = $this->findByIdWithRelations($id, ['gateway']);

        try {
            DB::beginTransaction();

            $gatewayName = $transaction['gateway']['name'];
            $gatewayApi = $this->gatewayService->getInstanceOfGatewayByName($gatewayName);

            $gatewayApi->refundTransaction($transaction['external_id']);

            $this->update($id, [
                'status' => TransactionStatusEnum::REFUNDED->value,
            ]);

            DB::commit();
        } catch (GatewayApiException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new BadRequestHttpException('There was an error while trying to process your refund.');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
