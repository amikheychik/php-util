<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\JWT\Claim\Claim;

interface Algorithm
  extends Claim {
  public const NAME = 'alg';

  /**
   * @throws Throwable
   *
   * @param string $content
   *
   * @return string
   */
  public function sign(string $content): string;
}
