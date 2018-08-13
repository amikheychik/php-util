<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\PKCS12;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\File\File;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\RegularFile;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Exception\OpenSSLException;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class PKCS12File
  implements Keypair {
  /** @var File */
  private $file;
  /** @var string */
  private $password;

  public function __construct(File $file, string $password) {
    $this->file = $file;
    $this->password = $password;
  }

  public function __destruct() {
    if ($this->key) {
      openssl_pkey_free($this->key);
    }
  }

  public function serialize() {
    try {
      return json_encode([$this->file->path()->absolute(), base64_encode($this->password)], JSON_UNESCAPED_SLASHES);
    }
    catch (\Throwable $e) {
      return null;
    }
  }

  /**
   * @throws Throwable
   *
   * @param string $serialized
   */
  public function unserialize($serialized) {
    $data = json_decode($serialized);
    try {
      $this->__construct(new FileFromPathString($data[0]), base64_decode($data[1]));
    }
    catch (Throwable $e) {
      throw new ChainException($e, 'Failed to unserialize data');
    }
  }

  /** @var null|false|resource */
  private $key;
  /** @var null|Throwable */
  private $exception;

  public function private() {
    if ($this->key === null) {
      try {
        $certificates = [];
        $key = new RegularFile($this->file);
        if (!openssl_pkcs12_read($key->content(), $certificates, $this->password)) {
          throw new OpenSSLException(new MessageWithTokens('Failed to parse PKCS#12 Certificate Store data'));
        }
        $this->key = openssl_pkey_get_private($certificates['pkey']);
        if ($this->key === false) {
          throw new OpenSSLException(new MessageWithTokens('Failed to read private key'));
        }
      }
      catch (\Throwable $e) {
        $this->key = false;
        $this->exception = $e;
      }
    }
    if ($e = $this->exception) {
      /** @var Throwable $e */
      throw $e;
    }
    return $this->key;
  }
}
