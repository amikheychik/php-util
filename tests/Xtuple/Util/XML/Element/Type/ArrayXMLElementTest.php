<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Element\XMLElementString;

final class ArrayXMLElementTest
  extends TestCase {
  public function testValue() {
    $array = new ArrayXMLElement(
      new XMLElementString(implode('', [
        '<Test attr="1">',
        '<Scalar>Value</Scalar>',
        '<Array attr="array"><Scalar attr="scalar">Value<Sub>Value</Sub></Scalar></Array>',
        '</Test>',
      ]))
    );
    self::assertEquals([
      'attr' => '1',
      'Scalar' => 'Value',
      'Array' => [
        'attr' => 'array',
        'Scalar' => 'Value',
      ],
    ], $array->value());
  }
}
