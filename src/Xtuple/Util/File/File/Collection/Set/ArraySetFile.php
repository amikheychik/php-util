<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\AbstractArraySet;
use Xtuple\Util\File\File\File;

final class ArraySetFile
  extends AbstractArraySet
  implements SetFile {
  /**
   * @param File[]|iterable $elements
   */
  public function __construct(array $elements = []) {
    parent::__construct($elements, function (File $element) {
      return $element->path()->absolute();
    });
  }
}
