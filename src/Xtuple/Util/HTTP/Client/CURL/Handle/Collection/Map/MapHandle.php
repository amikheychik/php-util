<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\HTTP\Client\CURL\Handle\Handle;

interface MapHandle
  extends Map {
  /**
   * @throws TypeThrowable
   *
   * @param resource $handle
   *
   * @return Handle
   */
  public function getByResource($handle): ?Handle;

  /**
   * @param string $key
   *
   * @return null|Handle
   */
  public function get(string $key);

  /**
   * @return null|Handle
   */
  public function current();
}
