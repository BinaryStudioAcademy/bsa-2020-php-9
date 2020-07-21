<?php

declare(strict_types=1);

namespace App\Actions\Requests;

class CreateStockRequest
{
	public \DateTime $startDate;
	public float $price;

	public function __construct(\DateTime $startDate, float $price)
	{
		$this->startDate = $startDate;
		$this->price = $price;
	}
}
