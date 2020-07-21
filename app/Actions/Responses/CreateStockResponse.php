<?php

declare(strict_types=1);

namespace App\Actions\Responses;

use App\Entities\Stock;

class CreateStockResponse
{
	public Stock $stock;

	public function __construct(Stock $stock)
	{
		$this->stock = $stock;
	}

	public function toArray()
	{
		return [
			"id" => $this->stock->id,
			"price" => $this->stock->price,
			"start_date" => $this->stock->start_date->format('Y-m-d H:i:s'),
		];
	}
}
