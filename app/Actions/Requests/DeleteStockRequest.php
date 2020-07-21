<?php

declare(strict_types=1);

namespace App\Actions\Requests;

class DeleteStockRequest
{
	public int $id;

	public function __construct(int $id)
	{
		$this->id = $id;
	}
}
