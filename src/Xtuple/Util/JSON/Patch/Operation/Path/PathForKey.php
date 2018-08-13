<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch\Operation\Path;

final class PathForKey
  extends AbstractPath {
  public function __construct(string $key, ?string $prefix) {
    parent::__construct(new PathStruct(
      implode('/', array_merge(
        [''],
        array_filter([$prefix, $key])
      ))
    ));
  }
}
