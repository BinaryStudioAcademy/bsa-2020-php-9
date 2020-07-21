<?php

declare(strict_types=1);

namespace App\DTO\Collections;

use App\DTO\Values\ChartData;
use Illuminate\Support\Collection;

class ChartDataCollection extends Collection
{
	public function add($item): self
	{
		if (!($item instanceof ChartData)) {
			throw new \LogicException('Added item has to be ChartData instance');
		}

		return parent::add($item);
	}

	public function toArray(): array
	{
		return $this->items;
	}
}
