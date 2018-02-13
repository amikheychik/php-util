<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class ArgumentWithTokens
  extends AbstractArgument {
  /**
   * @param string   $key
   * @param string   $string
   * @param string[] $tokens - key-value of strings
   */
  public function __construct(string $key, string $string, array $tokens = []) {
    parent::__construct($key, new MessageWithTokens($string, $tokens));
  }
}
