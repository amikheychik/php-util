<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options;

use PHPUnit\Framework\TestCase;

final class OptionsStructTest
  extends TestCase {
  public function testConstructor() {
    $options = new OptionsStruct([
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_RETURNTRANSFER => false,
      CURLOPT_HEADER => false,
    ]);
    self::assertEquals([
      52 => true,
      19913 => false,
      42 => false,
    ], $options->options());
  }
}
