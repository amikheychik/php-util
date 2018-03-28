<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set\Directory\Filter;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class FileExtension
  extends AbstractRegEx {
  public function __construct(string $extension) {
    parent::__construct(new RegExPattern(strtr('/^.+\.{extension}$/', [
      '{extension}' => $extension,
    ])));
  }
}
