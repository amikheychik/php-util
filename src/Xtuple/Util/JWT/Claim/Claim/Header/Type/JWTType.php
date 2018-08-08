<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Type;

final class JWTType
  extends AbstractType {
  public function __construct() {
    parent::__construct(new TypeStruct('JWT'));
  }
}
