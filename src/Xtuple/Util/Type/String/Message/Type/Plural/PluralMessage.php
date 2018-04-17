<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;
use Xtuple\Util\Type\String\Message\Message\Message;
use Xtuple\Util\Type\String\Message\Type\Number\NumberMessage;

/**
 * @see http://www.unicode.org/cldr/charts/latest/supplemental/language_plural_rules.html
 */
interface PluralMessage
  extends Message {
  public const ZERO = 'zero';
  public const ONE = 'one';
  public const TWO = 'two';
  public const FEW = 'few';
  public const MANY = 'many';
  public const OTHER = 'other';

  public function count(): NumberMessage;

  public function singular(): ?Message;

  public function plural(): Message;

  public function plurals(): MapArgument;

  public function offset(): ?float;
}
