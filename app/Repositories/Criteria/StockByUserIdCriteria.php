<?php

declare(strict_types=1);

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class StockByUserIdCriteria implements Criteria
{
	private int $userId;
	private int $stockId;

	public function __construct(int $stockId, int $userId)
	{
		$this->stockId = $stockId;
		$this->userId = $userId;
	}

	public function build(Builder $builder): Builder
	{
		return $builder->where([
			"id" => $this->stockId,
			"user_id" => $this->userId,
		]);
	}
}
