<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair;

abstract class AbstractKeypair
  implements Keypair {
  /** @var Keypair */
  private $keypair;

  public function __construct(Keypair $keypair) {
    $this->keypair = $keypair;
  }

  public final function serialize() {
    return serialize($this->keypair);
  }

  public final function unserialize($serialized) {
    $this->keypair = unserialize($serialized, ['allowed_classes' => true]);
  }

  public final function private() {
    return $this->keypair->private();
  }
}
