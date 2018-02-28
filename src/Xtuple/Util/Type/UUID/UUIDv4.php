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
    $strong = false;
    parent::__construct(new UUIDString(
      strtr('{time_low}-{time_mid}-{time_hi_and_version}-{clk_seq_hi_res}{clk_seq_low}-{node}', [
        '{time_low}' => bin2hex(openssl_random_pseudo_bytes(4, $strong)),
        '{time_mid}' => bin2hex(openssl_random_pseudo_bytes(2, $strong)),
        '{time_hi_and_version}' => dechex(hexdec(bin2hex(openssl_random_pseudo_bytes(2, $strong))) & 0x0fff | 0x4000),
        '{clk_seq_hi_res}' => dechex(hexdec(bin2hex(openssl_random_pseudo_bytes(1, $strong))) & 0x0f | 0x80),
        '{clk_seq_low}' => bin2hex(openssl_random_pseudo_bytes(1, $strong)),
        '{node}' => bin2hex(openssl_random_pseudo_bytes(6, $strong)),
      ])
    ));
    if (!$strong) {
      // @codeCoverageIgnoreStart
      // Exception is can not be reproduced in normal tests conditions as it depends on inner OpenSSL library behavior
      throw new Exception('Generated UUID is not cryptographically strong. Check your OpenSSL library.');
      // @codeCoverageIgnoreEnd
    }
  }
}
