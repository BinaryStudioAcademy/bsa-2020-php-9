<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\Contracts\StockRepository;
use App\Actions\Requests\CreateStockRequest;
use App\Actions\Responses\CreateStockResponse;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Auth\Guard;
use App\Entities\Stock;

class CreateStockAction
{
	private StockRepository $stockRepository;
	private Guard $auth;

	public function __construct(StockRepository $stockRepository, AuthFactory $authFactory)
	{
		$this->stockRepository = $stockRepository;
		$this->auth = $authFactory->guard();
	}

	public function execute(CreateStockRequest $request): CreateStockResponse
	{
		$user = $this->auth->user();
		$stock = new Stock();
		$stock->user_id = $user->id;
		$stock->price = $request->price;
		$stock->start_date = $request->startDate->format('Y-m-d H:i:s');

		$result = $this->stockRepository->create($stock);

		return new CreateStockResponse(
			$result
		);
	}
}
