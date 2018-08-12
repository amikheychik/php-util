<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record\Value;

use PHPUnit\Framework\TestCase;

final class ByteaTest
  extends TestCase {
  public function testLifecycle() {
    $value = new ByteaStruct(["Xtuple\Util"]);
    $serialized = $value->serialized();
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('YToxOntpOjA7czoxMToiWHR1cGxlXFV0aWwiO30=', $serialized);
    $unserialized = new ByteaSerialized($serialized);
    self::assertEquals(['Xtuple\\Util'], $unserialized->value());
    $value = new ByteaStruct(["Xtuple\Util\\\\Storage\\\\\\Postgres\\\\\\\\Cache"]);
    $serialized = $value->serialized();
    self::assertEquals(["Xtuple\Util\\\\Storage\\\\\\Postgres\\\\\\\\Cache"], $value->value());
    /** @noinspection SpellCheckingInspection */
    self::assertEquals(
      'YToxOntpOjA7czo0MDoiWHR1cGxlXFV0aWxcXFN0b3JhZ2VcXFxQb3N0Z3Jlc1xcXFxDYWNoZSI7fQ==',
      $serialized
    );
    $unserialized = new ByteaSerialized($serialized);
    self::assertEquals(["Xtuple\\Util\\\\Storage\\\\\\Postgres\\\\\\\\Cache"], $unserialized->value());
    self::assertEquals($serialized, $unserialized->serialized());
  }
}
