<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\DTO\Collections\ChartDataCollection;

interface MarketDataService
{
	public function getChartData(\DateTime $startDate, \DateTime $endDate, int $frequency): ChartDataCollection;
}
