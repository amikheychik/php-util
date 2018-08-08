<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL;

use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;

final class RS256OpenSSL
  extends AbstractOpenSSLAlgorithm {
  public function __construct(Keypair $key) {
    parent::__construct('RS256', OPENSSL_ALGO_SHA256, $key);
  }
}
