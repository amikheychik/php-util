<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class SelectMessageFromStrings
  extends AbstractSelectMessage {
  /**
   * @param string           $value
   * @param string           $default
   * @param string[]         $options
   * @param null|SetArgument $arguments
   */
  public function __construct(string $value, string $default, array $options = [], ?SetArgument $arguments = null) {
    $variants = [];
    foreach ($options as $key => $option) {
      $variants[] = new StringArgument((string) $key, (string) $option);
    }
    parent::__construct(new SelectMessageStruct(
      $value,
      new StringMessage($default),
      new ArraySetArgument($variants),
      $arguments
    ));
  }
}
