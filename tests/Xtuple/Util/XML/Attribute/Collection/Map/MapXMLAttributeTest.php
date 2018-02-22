<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Collection\Map;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Attribute\Type\Boolean\XMLAttributeBoolean;
use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

class MapXMLAttributeTest
  extends TestCase {
  public function testArrayMap() {
    $attributes = new ArrayMapXMLAttribute([
      new XMLAttributeStruct('database', 'phpunit'),
      new XMLAttributeBoolean('debug', true),
    ]);
    self::assertEquals('database="phpunit" debug="true"', (string) $attributes);
    self::assertEquals('phpunit', $attributes->get('database')->value());
    self::assertEquals(true, $attributes->get('debug')->value());
    self::assertEquals(2, $attributes->count());
  }
}
