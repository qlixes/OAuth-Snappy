<?php

namespace App\Services;

final class Responses
{
	private array $data = [];
	private array $format = [];

	function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	function asJson(int $httpCode = 200)
	{
		return response()->json($this->format, $httpCode);
	}

	function show(bool $status, string $message = "")
	{
		$format = [
			"status" => $status,
			"message" => $message,
		];

		if(isset($this->data))
		{
			$format = array_merge($format, $this->data);
		}

		return $this;
	}
}