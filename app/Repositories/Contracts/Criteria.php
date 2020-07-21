<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Criteria
{
	public function build(Builder $builder): Builder;
}
