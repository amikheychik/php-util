<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;

final class MessageWithTokens
  extends AbstractMessage {
  /**
   * @param string   $string
   * @param string[] $tokens - key-value of strings
   */
  public function __construct(string $string, array $tokens = []) {
    $arguments = [];
    foreach ($tokens as $token => $argument) {
      $arguments[] = new StringArgument((string) $token, (string) $argument);
    }
    /** @noinspection PhpUnhandledExceptionInspection - arguments type is checked */
    parent::__construct(new MessageStruct($string, new ArrayMapArgument($arguments)));
  }
}
