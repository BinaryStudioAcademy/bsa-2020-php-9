<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use App\Entities\Stock;

interface StockRepository
{
	public function create(Stock $stock): Stock;

	public function delete(Stock $stock): Stock;

	public function findByCriteria(Criteria $criteria): Collection;
}
