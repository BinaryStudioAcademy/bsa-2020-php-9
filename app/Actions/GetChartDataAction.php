<?php

declare(strict_types=1);

namespace App\Actions;

use App\Services\Contracts\MarketDataService;
use App\Actions\Requests\GetChartDataRequest;
use App\Actions\Responses\GetChartDataResponse;
use App\Services\Exceptions\InvalidFrequencyException;
use App\Exceptions\Api\LogicException;

class GetChartDataAction
{
	private MarketDataService $marketDataService;

	public function __construct(MarketDataService $marketDataService)
	{
		$this->marketDataService = $marketDataService;
	}

	public function execute(GetChartDataRequest $request): GetChartDataResponse
	{
		try {
			$chartDataCollection = $this->marketDataService->getChartData(
				$request->startDate,
				$request->endDate,
				$request->frequency,
			);
	
			return new GetChartDataResponse(
				$chartDataCollection
			);
		} catch (InvalidFrequencyException $e) {
			throw new LogicException($e->getMessage());
		}
	}
}
