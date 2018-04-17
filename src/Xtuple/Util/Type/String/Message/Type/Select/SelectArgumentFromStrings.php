<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\AbstractArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;

final class SelectArgumentFromStrings
  extends AbstractArgument {
  /**
   * @param string           $key
   * @param string           $value
   * @param string           $default
   * @param string[]         $options
   * @param null|MapArgument $arguments
   */
  public function __construct(string $key, string $value, string $default, array $options = [],
                              ?MapArgument $arguments = null) {
    parent::__construct($key, new SelectMessageFromStrings($value, $default, $options, $arguments));
  }
}
