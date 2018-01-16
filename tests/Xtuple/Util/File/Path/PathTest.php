<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

use PHPUnit\Framework\TestCase;

class PathTest
  extends TestCase {
  public function testString() {
    $path = new TestPath(new PathString('/tmp'));
    self::assertEquals('/tmp', $path->absolute());
    self::assertFalse($path->isFile());
    self::assertTrue($path->isDir());
    self::assertTrue($path->exists());
    $random = rand();
    $pathString = "/tmp/php-util-{$random}";
    if (!touch($pathString)) {
      self::fail(strtr('Failed to create a test file {file}', [
        '{file}' => $pathString,
      ]));
    }
    $path = new TestPath(new PathString($pathString));
    self::assertEquals($pathString, $path->absolute());
    self::assertTrue($path->isFile());
    self::assertFalse($path->isDir());
    self::assertTrue($path->exists());
    unlink($path->absolute());
    self::assertNull($path->absolute());
    self::assertFalse($path->exists());
    self::assertFalse($path->isFile());
    self::assertFalse($path->isDir());
  }
}

final class TestPath
  extends AbstractPath {
}
