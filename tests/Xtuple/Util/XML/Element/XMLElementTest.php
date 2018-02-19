<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use PHPUnit\Framework\TestCase;

class XMLElementTest
  extends TestCase {
  public function testEmpty() {
    $empty = new TestXMLElement(new XMLElementString('<Test/>'));
    self::assertEquals('Test', $empty->name());
    self::assertEquals('', $empty->xml());
    self::assertEquals('', $empty->value());
    self::assertTrue($empty->attributes()->isEmpty());
    self::assertTrue($empty->children()->isEmpty());
    self::assertEquals('none', $empty->attribute('none')->name());
    self::assertNull($empty->attribute('none')->value());
  }

  /**
   * @expectedException \InvalidArgumentException
   * @expectedExceptionMessage Passed element is an attribute.
   */
  public function testElement() {
    $element = new TestXMLElement(new XMLElementString(implode('', [
      '<Test name="test" debug="true" xmlns="https://xdruple.xtuple.com/schema/test">',
      '<Child name="empty"></Child>',
      '<Child name="not-empty">Test</Child>',
      '<Element>Element</Element>',
      'Content',
      '</Test>',
    ])));
    self::assertEquals('Test', $element->name());
    self::assertEquals(implode("\n", [
      '<?xml version="1.0"?>',
      '<Test name="test" debug="true"><Child name="empty"/><Child name="not-empty">Test</Child><Element>Element</Element>Content</Test>',
      '',
    ]), $element->xml());
    self::assertEquals('Content', $element->value());
    self::assertEquals(3, $element->children()->count());
    self::assertEquals(2, $element->children('Child')->count());
    self::assertEquals(2, $element->children('/Test/Child')->count());
    self::assertEquals('Test', $element->children('Child[@name="not-empty"]')->get(0)->value());
    self::assertEquals('true', $element->attribute('debug')->value());
    self::assertEquals(2, $element->attributes()->count());
    new XMLElementSimple((new \SimpleXMLElement('<Test name="test" />'))->attributes('name'));
  }
}

final class TestXMLElement
  extends AbstractXMLElement {
}
