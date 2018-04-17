<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedString;
use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedStringFromEncoded;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedString;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedStringFromDecoded;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\JSON\URLSafeBase64JSONEncodedArray;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

class Base64CharsTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage The input contains character from outside of the base64 alphabet.
   */
  public function testEncodeDecode() {
    $encoded = new Base64EncodedStringFromDecoded(
      new Base64DecodedString('decoded')
    );
    self::assertEquals('ZGVjb2RlZA==', $encoded->__toString());
    $decoded = new Base64DecodedStringFromEncoded($encoded);
    self::assertEquals('decoded', $decoded->__toString());
    $failed = new Base64DecodedStringFromEncoded(
      new Base64EncodedString('ŻGVjb2RlZÄ==')
    );
    $failed->__toString();
  }

  public function testURLSafe() {
    $encoded = new URLSafeBase64EncodedStringFromString('ZG-j_2RlZA');
    self::assertEquals('Wkctal8yUmxaQQ', $encoded->__toString());
  }

  public function testURLSafeJSON() {
    $encoded = new URLSafeBase64JSONEncodedArray([
      'decoded' => 'decoded',
      'encoded' => 'ZGVjb2RlZA',
    ]);
    self::assertEquals('eyJkZWNvZGVkIjoiZGVjb2RlZCIsImVuY29kZWQiOiJaR1ZqYjJSbFpBIn0', $encoded->__toString());
  }
}
