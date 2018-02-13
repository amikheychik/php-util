<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;

final class PluralArgumentFromStrings
  extends AbstractPluralArgument {
  /**
   * @param string         $key
   * @param int|float      $count
   * @param string         $plural   - "other" plural form is required by ICU and its difference with "many" would
   *                                 depend on the language.
   * @param null|string    $singular - singular form; is non-existent in some languages, but is required in English.
   * @param array          $plurals  - key-value list of other plural forms.
   * @param SetArgument    $arguments
   * @param int|float|null $offset
   */
  public function __construct(string $key, $count, string $plural, ?string $singular = null, array $plurals = [],
                              ?SetArgument $arguments = null, $offset = null) {
    parent::__construct($key, new PluralMessageFromStrings($count, $plural, $singular, $plurals, $arguments, $offset));
  }
}
