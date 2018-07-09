<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element\Sequence;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\SOAP\Element\XSD\Numeric\XSDIntElementStruct;
use Xtuple\Util\SOAP\Element\XSD\String\XSDStringElementStruct;
use Xtuple\Util\SOAP\Type\Sequence\SequenceTypeStruct;

class SequenceElementStructTest
  extends TestCase {
  public function testConstructor() {
    $type = new SequenceTypeStruct('TestExample', 'http://www.example.com/ExampleSchema');
    $elements = [];
    $element = new class(
      new SequenceElementStruct($type, 'Sequence', 'http://www.example.com/ExampleSchema', ...$elements)
    )
      extends AbstractSequenceElement {
    };
    self::assertEquals('TestExample', $element->type()->name());
    self::assertEquals('Sequence', $element->name());
    self::assertEquals('http://www.example.com/ExampleSchema', $element->namespace());
    self::assertEquals([], $element->soap()->value());
    $elements = [
      new XSDStringElementStruct('String', null, 'First'),
      new XSDStringElementStruct('String', null, 'Second'),
      new XSDIntElementStruct('Int', null, 42),
    ];
    $element = new class(
      new SequenceElementStruct($type, 'Sequence', 'http://www.example.com/ExampleSchema', ...$elements)
    )
      extends AbstractSequenceElement {
    };
    self::assertEquals('First', $element->soap()->value()['String'][0]->enc_value);
    self::assertEquals('Second', $element->soap()->value()['String'][1]->enc_value);
    self::assertEquals(42, $element->soap()->value()['Int']->enc_value);
  }
}
