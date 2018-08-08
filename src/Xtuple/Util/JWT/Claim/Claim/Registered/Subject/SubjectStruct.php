<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Subject;

use Xtuple\Util\JWT\Claim\Type\StringOrURI\AbstractStringOrURIClaim;
use Xtuple\Util\JWT\Claim\Type\StringOrURI\StringOrURIClaimStruct;

final class SubjectStruct
  extends AbstractStringOrURIClaim
  implements Subject {
  public function __construct(string $subject) {
    parent::__construct(new StringOrURIClaimStruct(Subject::NAME, $subject));
  }
}
