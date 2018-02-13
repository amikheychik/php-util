<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\Argument;

abstract class AbstractSelectArgument
  extends AbstractSelectMessage
  implements Argument {
  /** @var string */
  private $key;

  public function __construct(string $key, SelectMessage $message) {
    parent::__construct($message);
    $this->key = $key;
  }

  public final function key(): string {
    return $this->key;
  }
}
