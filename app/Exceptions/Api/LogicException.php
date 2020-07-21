<?php

declare(strict_types=1);

namespace App\Exceptions\Api;

use Illuminate\Contracts\Support\Responsable;

class LogicException extends \Exception implements Responsable
{
	public function toResponse($request)
	{
		return response()->json([
			"message" => $this->getMessage()
		], 400);
	}
}
