<?php

declare(strict_types=1);

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class PeriodCriteria implements Criteria
{
	private \DateTime $start;
	private \DateTime $end;

	public function __construct(\DateTime $start, \DateTime $end)
	{
		$this->start = $start;
		$this->end = $end;
	}

	public function build(Builder $builder): Builder
	{
		return $builder->whereBetween('start_date', [
			$this->start,
			$this->end,
		])->orderBy('start_date');
	}
}
