<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm;

final class NoneAlgorithm
  extends AbstractAlgorithm {
  public function __construct() {
    parent::__construct('none');
  }

  public function sign(string $content): string {
    return '';
  }
}
