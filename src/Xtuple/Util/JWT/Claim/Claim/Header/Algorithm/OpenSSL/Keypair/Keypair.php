<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair;

use Xtuple\Util\Exception\Throwable;

interface Keypair
  extends \Serializable {
  /**
   * @throws Throwable
   * @return resource
   * @see openssl_pkey_get_private()
   */
  public function private();
}
