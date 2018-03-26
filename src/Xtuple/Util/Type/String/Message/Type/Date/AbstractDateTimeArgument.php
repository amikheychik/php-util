<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Date;

use Xtuple\Util\Type\String\Message\Argument\Argument;

abstract class AbstractDateTimeArgument
  extends AbstractDateTimeMessage
  implements Argument {
  /** @var string */
  private $key;

  public function __construct(string $key, DateTimeMessage $date) {
    parent::__construct($date);
    $this->key = $key;
  }

  public final function key(): string {
    return $this->key;
  }
}
