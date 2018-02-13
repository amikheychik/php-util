<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Encode;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedString;
use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedStringFromEncoded;
use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedStringFromMixed;

class HTMLCharsTest
  extends TestCase {
  public function testEncodeDecode() {
    $default = ini_get('default_charset');
    ini_set('default_charset', 'iso-8859-1');
    $encoded = new HTMLEncodedStringFromDecoded(new HTMLDecodedString('<a href="/">Home\'s page</a>'));
    self::assertEquals('&lt;a href=&quot;/&quot;&gt;Home\'s page&lt;/a&gt;', $encoded->__toString());
    self::assertEquals('iso-8859-1', $encoded->charset());
    self::assertEquals(2, $encoded->quotes());
    $encoded = new HTMLEncodedStringFromDecoded(
      new HTMLDecodedString('<a href="/">Home\'s page</a>', ENT_QUOTES, 'UTF-8')
    );
    self::assertEquals('&lt;a href=&quot;/&quot;&gt;Home&#039;s page&lt;/a&gt;', $encoded->__toString());
    self::assertEquals('UTF-8', $encoded->charset());
    self::assertEquals(3, $encoded->quotes());
    ini_set('default_charset', $default);
    $decoded = new HTMLDecodedStringFromEncoded($encoded);
    self::assertEquals('<a href="/">Home\'s page</a>', $decoded->__toString());
    self::assertEquals('UTF-8', $decoded->charset());
    self::assertEquals(3, $decoded->quotes());
    $decoded = new HTMLDecodedStringFromMixed('&lt;a href=&quot;/&quot;&gt;Home&#039;s page&lt;/a&gt;', ENT_QUOTES);
    self::assertEquals('<a href="/">Home\'s page</a>', $decoded->__toString());
    self::assertEquals('UTF-8', $decoded->charset());
    self::assertEquals(3, $decoded->quotes());
  }
}
