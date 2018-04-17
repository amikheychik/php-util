<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Type\Dictionary;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Element\XMLElementString;

final class ArrayXMLElementTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testValue() {
    $array = new ArrayXMLElement(
      new XMLElementString(implode('', [
        '<Test attr="1">',
        '<Scalar>Value</Scalar>',
        '<Array attr="array"><Scalar attr="scalar">Value<Sub>Value</Sub></Scalar></Array>',
        '<li>List item 1</li>',
        '<li>List item 2</li>',
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
      'List item 1',
      'List item 2',
    ], $array->value());
    $array = new ArrayXMLElement(
      new XMLElementString(implode('', [
        '<Test attr="1">',
        '<Scalar>Value 1</Scalar>',
        '<Scalar>Value 2</Scalar>',
        '<li>List item 1</li>',
        '<li>List item 2</li>',
        '</Test>',
      ]))
    );
    self::assertEquals([
      'attr' => '1',
      'Scalar' => ['Value 1', 'Value 2'],
      'li' => ['List item 1', 'List item 2'],
    ], $array->value());
  }
}
