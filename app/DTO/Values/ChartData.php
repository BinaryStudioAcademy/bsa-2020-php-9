<?php

declare(strict_types=1);

namespace App\DTO\Values;

class ChartData
{
	private float $price;
	private \DateTime $date;

	public function __construct(\DateTime $date, float $price)
	{
		$this->price = $price;
		$this->date = $date;
	}

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}
