<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\config;

final class NetherConfiguration{

	/**
	 * @param array $data
	 * @return self
	 *
	 * @phpstan-param array<string, mixed> $data
	 */
	public static function fromData(array $data) : self{
		$instance = new self(
			ConfigurationHelper::readString($data, "world"),
			ConfigurationHelper::readOptional($data, "sub-worlds", []),
			ConfigurationHelper::readInt($data, "teleportation-duration", 0),
			NetherPortalConfiguration::fromData(ConfigurationHelper::readMap($data, "portal"))
		);
		ConfigurationHelper::checkForUnread($data);
		return $instance;
	}

	/**
	 * @param string $world
	 * @param string[] $sub_worlds
	 * @param int $teleportation_duration
	 * @param NetherPortalConfiguration $portal
	 */
	public function __construct(
		private string $world,
		private array $sub_worlds,
		private int $teleportation_duration,
		private NetherPortalConfiguration $portal
	){}

	public function getWorld() : string{
		return $this->world;
	}

	/**
	 * @return string[]
	 */
	public function getSubWorlds() : array{
		return $this->sub_worlds;
	}

	public function getTeleportationDuration() : int{
		return $this->teleportation_duration;
	}

	public function getPortal() : NetherPortalConfiguration{
		return $this->portal;
	}
}