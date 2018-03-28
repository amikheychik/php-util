<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Regular;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\Directory\DirectoryPath;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\Copy\CopyRegularFile;
use Xtuple\Util\File\File\Regular\Create\CreateRegularFileFromString;

class RegularTest
  extends TestCase {
  private $dir = '/tmp/phpunit/php-util';

  /**
   * @throws Throwable
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

  public function testFile() {
    /** @noinspection PhpUnhandledExceptionInspection */
    $created = new CreateRegularFileFromString("{$this->dir}/create.test", 'Test content');
    self::assertEquals('/tmp/phpunit/php-util/create.test', $created->path()->absolute());
    self::assertEquals('create.test', $created->name());
    self::assertEquals('Test content', $created->content());
    self::assertEquals(filemtime($created->path()->absolute()), $created->modified());
    /** @noinspection PhpUnhandledExceptionInspection */
    $copied = new CopyRegularFile($created, "{$this->dir}/copy.test");
    self::assertEquals('/tmp/phpunit/php-util/copy.test', $copied->path()->absolute());
    self::assertEquals('copy.test', $copied->name());
    self::assertEquals('Test content', $copied->content());
    self::assertEquals(filemtime($copied->path()->absolute()), $copied->modified());
    /** @noinspection PhpUnhandledExceptionInspection */
    $read = new RegularFile(new FileFromPathString("{$this->dir}/copy.test"));
    self::assertEquals('/tmp/phpunit/php-util/copy.test', $read->path()->absolute());
    self::assertEquals('copy.test', $read->name());
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertEquals('Test content', $read->content());
    self::assertEquals(filemtime($read->path()->absolute()), $read->modified());
    unlink("{$this->dir}/create.test");
    unlink("{$this->dir}/copy.test");
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Exception
   * @expectedExceptionMessage File /tmp/phpunit/php-util is not a regular file
   */
  public function testRegularFileConstructorError() {
    /** @noinspection PhpUnhandledExceptionInspection */
    new RegularFile(new DirectoryPath($this->dir));
  }

  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage Failed to read file /tmp/phpunit/php-util/test content
   * @throws Throwable
   */
  public function testRegularFileContentError() {
    touch("{$this->dir}/test");
    $file = new RegularFile(new FileFromPathString("{$this->dir}/test"));
    chmod("{$this->dir}/test", 0377);
    $file->content();
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
    catch (Throwable $e) {
      self::assertContains(
        'copy(): The second argument to copy() function cannot be a directory',
        $e->getMessage()
      );
      error_reporting($previous);
    }
  }
}
