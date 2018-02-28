<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

interface UUID {
  public function __toString(): string;

  public function urn(): string;

  public function equals(UUID $uuid): bool;
}
