<?php

declare(strict_types=1);

namespace App\Services\Exceptions;

class InvalidFrequencyException extends \InvalidArgumentException
{
	const ERROR_MESSAGE = 'Frequency must be greater than 0';

	public function __construct()
	{
		parent::__construct(self::ERROR_MESSAGE);
	}
}
