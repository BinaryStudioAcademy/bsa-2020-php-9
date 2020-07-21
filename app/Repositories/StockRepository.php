<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Stock;
use App\Repositories\Contracts\{
	StockRepository as IStockRepository,
	Criteria
};
use Illuminate\Support\Collection;

class StockRepository implements IStockRepository
{
	public function create(Stock $stock): Stock
	{
		$stock->save();

		return $stock;
	}

	public function delete(Stock $stock): Stock
	{
		$stock->delete();

		return $stock;
	}

	public function findByCriteria(Criteria $criteria): Collection
	{
		return $criteria->build((new Stock())->newQuery())->get();
	}
}
