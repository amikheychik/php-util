<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim;

use Xtuple\Util\Type\String\Chars;

interface Claim
  extends Chars {
  public function name(): string;

  /**
   * @return mixed
   */
  public function value();
}
