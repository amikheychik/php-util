<?php declare(strict_types=1);

namespace Xtuple\Util\JWT;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaim;

interface JWT {
  /**
   * @throws Throwable
   * @return string
   */
  public function encoded(): string;

  public function header(): HeaderMapClaim;

  public function payload(): PayloadMapClaim;
}
