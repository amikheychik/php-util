<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Header;

use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\Algorithm;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\NoneAlgorithm;
use Xtuple\Util\JWT\Claim\Claim\Header\Type\JWTType;
use Xtuple\Util\JWT\Claim\Claim\Header\Type\Type;
use Xtuple\Util\JWT\Claim\Collection\Map\AbstractMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\MapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\MergedMapClaim;

final class HeaderMapClaimStruct
  extends AbstractMapClaim
  implements HeaderMapClaim {
  /** @var Algorithm */
  private $algorithm;

  public function __construct(?Algorithm $algorithm = null, ?Type $type = null, ?MapClaim $claims = null) {
    $this->algorithm = $algorithm ?: new NoneAlgorithm();
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new MergedMapClaim(
      new ArrayMapClaim([
        $type ?: new JWTType(),
        $this->algorithm,
      ]),
      $claims ?: new ArrayMapClaim()
    ));
  }

  public function algorithm(): Algorithm {
    return $this->algorithm;
  }
}
