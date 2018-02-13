<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\AbstractArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;

final class SelectArgumentFromStrings
  extends AbstractArgument {
  /**
   * @param string           $key
   * @param string           $value
   * @param string           $default
   * @param string[]         $options
   * @param null|SetArgument $arguments
   */
  public function __construct(string $key, string $value, string $default, array $options = [],
                              ?SetArgument $arguments = null) {
    parent::__construct($key, new SelectMessageFromStrings($value, $default, $options, $arguments));
  }
}
