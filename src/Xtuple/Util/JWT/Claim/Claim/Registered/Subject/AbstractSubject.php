<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Subject;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;

abstract class AbstractSubject
  extends AbstractStringOrURIClaim
  implements Subject {
  public function __construct(Subject $claim) {
    parent::__construct($claim);
  }
}
