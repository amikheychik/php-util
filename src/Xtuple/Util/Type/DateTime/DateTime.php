<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

use Xtuple\Util\Type\String\Chars;

interface DateTime
  extends \Serializable,
          \JsonSerializable,
          Chars {
  public function utc(): string;

  public function compare(DateTime $to): int;

  public function equals(DateTime $to): bool;
}
