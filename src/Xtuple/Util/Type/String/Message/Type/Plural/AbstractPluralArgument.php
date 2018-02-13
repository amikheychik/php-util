<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Argument;

abstract class AbstractPluralArgument
  extends AbstractPluralMessage
  implements Argument {
  /** @var string */
  private $key;

  public function __construct(string $key, PluralMessage $message) {
    parent::__construct($message);
    $this->key = $key;
  }

  public final function key(): string {
    return $this->key;
  }
}
