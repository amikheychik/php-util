<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\DirectoryPath;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\Copy\CopyRegularFile;
use Xtuple\Util\File\File\Regular\Create\CreateRegularFileFromString;

class RegularTest
  extends TestCase {
  private $dir = '/tmp/phpunit/php-util';

  /**
   * @throws \Throwable
   */
  public function setUp() {
    parent::setUp();
    new MakeDirectoryPath($this->dir);
  }

  public function tearDown() {
    parent::tearDown();
    if (file_exists("{$this->dir}/test")) {
      unlink("{$this->dir}/test");
    }
    if (file_exists("{$this->dir}/create.test")) {
      unlink("{$this->dir}/create.test");
    }
    rmdir($this->dir);
  }

  /**
   * @throws \Throwable
   */
  public function testFile() {
    $created = new CreateRegularFileFromString("{$this->dir}/create.test", 'Test content');
    self::assertEquals('/tmp/phpunit/php-util/create.test', $created->path()->absolute());
    self::assertEquals('create.test', $created->name());
    self::assertEquals('Test content', $created->content());
    self::assertEquals(filemtime($created->path()->absolute()), $created->modified());
    $copied = new CopyRegularFile($created, "{$this->dir}/copy.test");
    self::assertEquals('/tmp/phpunit/php-util/copy.test', $copied->path()->absolute());
    self::assertEquals('copy.test', $copied->name());
    self::assertEquals('Test content', $copied->content());
    self::assertEquals(filemtime($copied->path()->absolute()), $copied->modified());
    $read = new RegularFile(new FileFromPathString("{$this->dir}/copy.test"));
    self::assertEquals('/tmp/phpunit/php-util/copy.test', $read->path()->absolute());
    self::assertEquals('copy.test', $read->name());
    self::assertEquals('Test content', $read->content());
    self::assertEquals(filemtime($read->path()->absolute()), $read->modified());
    unlink("{$this->dir}/create.test");
    unlink("{$this->dir}/copy.test");
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage File /tmp/phpunit/php-util is not a regular file
   * @throws \Throwable
   */
  public function testRegularFileConstructorError() {
    new RegularFile(new DirectoryPath($this->dir));
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Failed to read file /tmp/phpunit/php-util/test content
   * @throws \Throwable
   */
  public function testRegularFileContentError() {
    touch("{$this->dir}/test");
    $file = new RegularFile(new FileFromPathString("{$this->dir}/test"));
    chmod("{$this->dir}/test", 0377);
    $file->content();
  }

  public function testCreateRegularFileFromString() {
    try {
      new MakeDirectoryPath("{$this->dir}/create.test");
      new CreateRegularFileFromString("{$this->dir}/create.test", 'Test content');
    }
    catch (\Throwable $e) {
      self::assertContains(
        'fopen(/tmp/phpunit/php-util/create.test): failed to open stream',
        (string) $e
      );
      self::assertContains(
        'Failed to create file ',
        $e->getMessage()
      );
    }
    finally {
      rmdir("{$this->dir}/create.test");
    }
    if (!isset($e)) {
      self::fail('Exception "Failed to create file" is not thrown');
    }
  }

  public function testCopyRegularFileError() {
    $previous = error_reporting(0);
    try {
      new CopyRegularFile(
        new CreateRegularFileFromString("{$this->dir}/create.test", 'Test content'),
        $this->dir
      );
      self::fail('Exception "copy()" is not thrown');
    }
    catch (\Throwable $e) {
      self::assertContains(
        'copy(): The second argument to copy() function cannot be a directory',
        (string) $e
      );
      self::assertContains(
        'File /tmp/phpunit/php-util/create.test copy to /tmp/phpunit/php-util failed',
        $e->getMessage()
      );
      error_reporting($previous);
    }
  }
}
