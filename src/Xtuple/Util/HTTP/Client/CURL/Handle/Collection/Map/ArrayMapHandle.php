<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\StrictType\AbstractStrictlyTypedArrayMap;
use Xtuple\Util\Generics\Type\ResourceType;
use Xtuple\Util\HTTP\Client\CURL\Handle\Handle;

final class ArrayMapHandle
  extends AbstractStrictlyTypedArrayMap
  implements MapHandle {
  /**
   * @throws \Throwable - if $elements contains an element of a wrong type.
   *
   * @param Handle[]|iterable $elements
   */
  public function __construct(iterable $elements = []) {
    parent::__construct(Handle::class, $elements, 'key');
  }

  public function getByResource($handle): ?Handle {
    $handle = (new ResourceType())->cast($handle);
    foreach ($this as $element) {
      /** @var Handle $element */
      if ($element->handle() === $handle) {
        return $element;
      }
    }
    return null;
  }
}
