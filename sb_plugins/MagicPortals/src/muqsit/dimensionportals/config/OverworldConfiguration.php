<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\config;

final class OverworldConfiguration
{

	/**
	 * @param array $data
	 * @return self
	 *
	 * @phpstan-param array<string, mixed> $data
	 */
	public static function fromData(array $data): self
	{
		$instance = new self(ConfigurationHelper::readString($data, "world"));
		ConfigurationHelper::checkForUnread($data);
		return $instance;
	}

	public function __construct(
		private string $world
	) {
	}

	public function getWorld(): string
	{
		return $this->world;
	}
}
