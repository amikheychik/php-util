<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path\Relative;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\Regular\Create\CreateRegularFileFromString;

class RelativePathTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testPathInDirectory() {
    $dir = new MakeDirectoryPath('/tmp/phpunit/php-util/dir-test/relative');
    $file = new CreateRegularFileFromString("{$dir->path()->absolute()}/create.test", 'Test content');
    $relative = new RelativePathInDirectory($dir, $file);
    self::assertEquals('create.test', $relative->relative());
    self::assertEquals('/tmp/phpunit/php-util/dir-test/relative/create.test', $relative->absolute());
    self::assertTrue($relative->exists());
    self::assertTrue($relative->isFile());
    self::assertFalse($relative->isDir());
    try {
      $file = new CreateRegularFileFromString('/tmp/phpunit/php-util/dir-test/create.test', 'Test content');
      new RelativePathInDirectory($dir, $file);
      self::fail(
        'Expected exception: "File /tmp/phpunit/php-util/dir-test/create.test is not located in directory" is missing'
      );
    }
    catch (\Throwable $e) {
      self::assertContains(
        'File /tmp/phpunit/php-util/dir-test/create.test is not located in directory',
        $e->getMessage()
      );
      unlink('/tmp/phpunit/php-util/dir-test/create.test');
    }
    unlink('/tmp/phpunit/php-util/dir-test/relative/create.test');
    rmdir('/tmp/phpunit/php-util/dir-test/relative');
    rmdir('/tmp/phpunit/php-util/dir-test');
  }

  /**
   * @throws \Throwable
   */
  public function testPathToFile() {
    $from = '/tmp/phpunit/drupal/core/sites/default/files';
    $to = new MakeDirectoryPath('/tmp/phpunit/web/files');
    $path = new TestRelativePath(new RelativePathToFile($from, $to));
    self::assertEquals('../../../../../web/files', $path->relative());
    self::assertEquals('/tmp/phpunit/web/files', $path->absolute());
    self::assertTrue($path->exists());
    self::assertFalse($path->isFile());
    self::assertTrue($path->isDir());
    $from = '/tmp/phpunit/drupal/core/sites/all/libraries/xdruple';
    $to = new MakeDirectoryPath('/tmp/phpunit/drupal/xdruple/drupal/libraries');
    $path = new RelativePathToFile($from, $to);
    self::assertEquals('../../../../../xdruple/drupal/libraries', $path->relative());
    self::assertEquals('/tmp/phpunit/drupal/xdruple/drupal/libraries', $path->absolute());
    self::assertTrue($path->exists());
    self::assertFalse($path->isFile());
    self::assertTrue($path->isDir());
  }
}

final class TestRelativePath
  extends AbstractRelativePath {
}
