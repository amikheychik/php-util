<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;

class PathTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Path /tmp/phpunit/php-util/path does not exist
   * @throws \Throwable
   */
  public function testString() {
    $path = new TestPath(new PathString('/tmp'));
    self::assertEquals('/tmp', $path->absolute());
    self::assertFalse($path->isFile());
    self::assertTrue($path->isDir());
    self::assertTrue($path->exists());
    new MakeDirectoryPath('/tmp/phpunit/php-util');
    $pathString = '/tmp/phpunit/php-util/path';
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
    rmdir('/tmp/phpunit/php-util');
    self::assertFalse($path->exists());
    self::assertFalse($path->isFile());
    self::assertFalse($path->isDir());
    $path->absolute();
  }
}

final class TestPath
  extends AbstractPath {
}
