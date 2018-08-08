<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\AbstractAlgorithm;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Exception\OpenSSLException;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

abstract class AbstractOpenSSLAlgorithm
  extends AbstractAlgorithm {
  /** @var int */
  private $algorithm;
  /** @var Keypair */
  private $key;

  /**
   * @param string  $name
   * @param int     $algorithm
   * @param Keypair $key
   *
   * @see http://php.net/manual/en/openssl.signature-algos.php
   */
  public function __construct(string $name, int $algorithm, Keypair $key) {
    parent::__construct($name);
    $this->algorithm = $algorithm;
    $this->key = $key;
  }

  public final function sign(string $content): string {
    try {
      if (openssl_sign($content, $signature, $this->key->private(), $this->algorithm) === false) {
        throw new OpenSSLException(new MessageWithTokens('Failed to create signature'));
      }
      return $signature;
    }
    catch (\Throwable $e) {
      throw new ChainException($e, 'Failed to sign data');
    }
  }
}
