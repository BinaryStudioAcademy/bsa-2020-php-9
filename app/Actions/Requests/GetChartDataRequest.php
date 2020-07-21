<?php

declare(strict_types=1);

namespace App\Actions\Requests;

class GetChartDataRequest
{
	public \DateTime $startDate;
	public \DateTime $endDate;
	public int $frequency;

	public function __construct(\DateTime $startDate, \DateTime $endDate, int $frequency)
	{
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->frequency = $frequency;
	}
}
