<?php

declare(strict_types=1);

namespace App\Actions\Responses;

use App\DTO\Collections\ChartDataCollection;
use App\DTO\Values\ChartData;

class GetChartDataResponse
{
	public ChartDataCollection $chartDataCollection;

	public function __construct(ChartDataCollection $chartDataCollection)
	{
		$this->chartDataCollection = $chartDataCollection;
	}

	public function toArray()
	{
		return $this->chartDataCollection->map(fn(ChartData $item) => [
			"price" => $item->getPrice(),
			"date" => $item->getDate()->format('Y-m-d H:i:s'),
		]);
	}
}
