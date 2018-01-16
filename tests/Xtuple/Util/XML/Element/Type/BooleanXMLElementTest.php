<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Element\XMLElementString;

class BooleanXMLElementTest
  extends TestCase {
  public function testBoolean() {
    $element = new BooleanXMLElement(new XMLElementString('<Test>true</Test>'));
    self::assertTrue($element->value());
    $element = new BooleanXMLElement(new XMLElementString('<Test>False</Test>'));
    self::assertFalse($element->value());
    $element = new BooleanXMLElement(new XMLElementString('<Test>1</Test>'));
    self::assertFalse($element->value());
  }
}
