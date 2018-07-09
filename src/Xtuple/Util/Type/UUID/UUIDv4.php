<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

use Xtuple\Util\Exception\Exception;

/**
 * @see https://tools.ietf.org/html/rfc4122
 */
final class UUIDv4
  extends AbstractUUID {
  /**
   * @throws \Throwable
   */
  public function __construct() {
    try {
      parent::__construct(new UUIDString(
        strtr('{time_low}-{time_mid}-{time_hi_and_version}-{clk_seq_hi_res}{clk_seq_low}-{node}', [
          '{time_low}' => bin2hex(random_bytes(4)),
          '{time_mid}' => bin2hex(random_bytes(2)),
          '{time_hi_and_version}' => dechex(hexdec(bin2hex(random_bytes(2))) & 0x0fff | 0x4000),
          '{clk_seq_hi_res}' => dechex(hexdec(bin2hex(random_bytes(1))) & 0x0f | 0x80),
          '{clk_seq_low}' => bin2hex(random_bytes(1)),
          '{node}' => bin2hex(random_bytes(6)),
        ])
      ));
    }
      // @codeCoverageIgnoreStart
      // Exception is can not be reproduced in normal tests conditions.
    catch (\Throwable $e) {
      throw new Exception('Generated UUID is not cryptographically strong. Check random_bytes() documentation.');
    }
    // @codeCoverageIgnoreEnd
  }
}
