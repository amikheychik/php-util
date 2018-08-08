<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

final class MergedMapClaim
  extends AbstractMapClaim {
  public function __construct(MapClaim... $maps) {
    $elements = [];
    foreach ($maps as $claims) {
      foreach ($claims as $claim) {
        $elements[] = $claim;
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new ArrayMapClaim($elements));
  }
}
