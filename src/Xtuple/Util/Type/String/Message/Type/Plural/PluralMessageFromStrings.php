<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Float\FloatMessage;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class PluralMessageFromStrings
  extends AbstractPluralMessage
  implements PluralMessage {
  /**
   * @param float|int        $count
   * @param string           $plural
   * @param string           $singular
   * @param string[]         $plurals
   * @param null|SetArgument $arguments
   * @param float|int|null   $offset
   */
  public function __construct($count, string $plural, string $singular, array $plurals = [],
                              ?SetArgument $arguments = null, $offset = null) {
    $forms = [];
    foreach ($plurals as $value => $form) {
      $forms[] = new StringArgument($value, $form);
    }
    parent::__construct(new PluralMessageStruct(
      new FloatMessage((float) $count),
      new StringMessage($plural),
      new StringMessage($singular),
      new ArraySetArgument($forms),
      $arguments,
      (float) $offset
    ));
  }
}
