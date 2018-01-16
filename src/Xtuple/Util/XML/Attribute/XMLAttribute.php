<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute;

interface XMLAttribute {
  public function name(): string;

  /**
   * @return mixed
   */
  public function value();
}
