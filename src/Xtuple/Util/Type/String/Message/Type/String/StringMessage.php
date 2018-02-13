<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\String;

use Xtuple\Util\Type\String\Message\Message\AbstractScalarMessage;

final class StringMessage
  extends AbstractScalarMessage {
  /** @var string */
  private $message;

  public function __construct(string $message) {
    parent::__construct($message);
    $this->message = $message;
  }

  public function format(string $locale): string {
    return $this->message;
  }
}
