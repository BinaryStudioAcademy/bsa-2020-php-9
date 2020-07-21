<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Contracts\Auth\Factory as AuthFactory;
use App\Exceptions\Api\NotFoundException;
use App\Repositories\Criteria\StockByUserIdCriteria;
use App\Repositories\Contracts\StockRepository;
use App\Actions\Requests\DeleteStockRequest;
use App\Actions\Responses\DeleteStockResponse;
use Illuminate\Contracts\Auth\Guard;
use App\Entities\Stock;

class DeleteStockAction
{
	private StockRepository $stockRepository;
	private Guard $auth;

	public function __construct(StockRepository $stockRepository, AuthFactory $authFactory)
	{
		$this->stockRepository = $stockRepository;
		$this->auth = $authFactory->guard();
	}

	public function execute(DeleteStockRequest $request): DeleteStockResponse
	{
		$user = $this->auth->user();
		$stocks = $this->stockRepository->findByCriteria(
			new StockByUserIdCriteria(
				$request->id,
				$user->id,
			)
		);

		if ($stocks->isEmpty()) {
			throw new NotFoundException('Stock not found');
		}

		$this->stockRepository->delete($stocks[0]);

		return new DeleteStockResponse();
	}
}
