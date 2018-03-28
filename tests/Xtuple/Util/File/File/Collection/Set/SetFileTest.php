<?php declare(strict_types=1);

namespace Xtuple\Util\File\File\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\Directory;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\File\File\Collection\Set\Directory\AbstractDirectorySetFile;
use Xtuple\Util\File\File\Collection\Set\Directory\DirectoryFilteredSetFile;
use Xtuple\Util\File\File\Collection\Set\Directory\DirectorySetFileStruct;
use Xtuple\Util\File\File\Collection\Set\Directory\Filter\FileExtension;
use Xtuple\Util\File\File\Collection\Set\Directory\RecursiveDirectoryFilteredSetFile;
use Xtuple\Util\File\File\Collection\Set\Directory\RecursiveDirectorySetFile;
use Xtuple\Util\File\File\Regular\Create\CreateRegularFileFromString;
use Xtuple\Util\File\File\Regular\Regular;
use Xtuple\Util\File\File\Regular\RegularFile;
use Xtuple\Util\RegEx\RegExPattern;

class SetFileTest
  extends TestCase {
  /** @var Directory */
  private $sandbox;
  /** @var Directory */
  private $dir;
  /** @var Directory */
  private $empty;
  /** @var SetFile */
  private $files;

  /**
   * @throws \Throwable
   */
  public function setUp() {
    parent::setUp();
    $this->sandbox = new MakeDirectoryPath('/tmp/phpunit/php-util');
    $this->dir = new MakeDirectoryPath('/tmp/phpunit/php-util/files');
    $this->empty = new MakeDirectoryPath('/tmp/phpunit/php-util/files/empty');
    $this->files = new ArraySetFile([
      $this->empty,
      new CreateRegularFileFromString("{$this->dir->path()->absolute()}/file1.test", 'Test 1'),
      new CreateRegularFileFromString("{$this->dir->path()->absolute()}/file2.test", 'Test 2'),
      new CreateRegularFileFromString("{$this->dir->path()->absolute()}/file3.test", 'Test 3'),
      new CreateRegularFileFromString("{$this->dir->path()->absolute()}/file.mock", 'Mock'),
      new CreateRegularFileFromString("{$this->dir->path()->absolute()}/file.stub", 'Stub'),
    ]);
  }

  public function tearDown() {
    parent::tearDown();
    foreach ($this->files as $file) {
      if ($file->path()->isFile()) {
        unlink($file->path()->absolute());
      }
    }
    rmdir($this->empty->path()->absolute());
    rmdir($this->dir->path()->absolute());
  }

  public function testArraySet() {
    self::assertFalse($this->files->isEmpty());
    self::assertEquals(6, $this->files->count());
    /** @var Regular $file */
    $file = $this->files->get("{$this->dir->path()->absolute()}/file.mock");
    self::assertEquals('Mock', $file->content());
  }

  public function testDirectorySetFileStruct() {
    $files = new TestDirectorySetFile(new DirectorySetFileStruct($this->dir));
    self::assertEquals($this->dir->path()->absolute(), $files->directory()->path()->absolute());
    self::assertFalse($files->isEmpty());
    self::assertEquals(6, $files->count());
    foreach ($files as $path => $file) {
      $fileInPath = $this->files->get($path);
      if ($fileInPath->path()->isFile()) {
        self::assertEquals(
          $fileInPath->path()->absolute(),
          $file->path()->absolute()
        );
      }
      else {
        self::assertTrue($fileInPath->path()->isDir());
        self::assertEquals('empty', $fileInPath->name());
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertEquals('Mock', (new RegularFile($files->get("{$this->dir->path()->absolute()}/file.mock")))->content());
    self::assertNull($files->get("{$this->dir->path()->absolute()}/mock.file"));
    $files = new TestDirectorySetFile(new DirectorySetFileStruct($this->empty));
    self::assertTrue($files->isEmpty());
  }

  public function testDirectoryFilteredSetFileStruct() {
    $files = new DirectoryFilteredSetFile($this->dir, new FileExtension('test'));
    self::assertEquals($this->dir->path()->absolute(), $files->directory()->path()->absolute());
    self::assertFalse($files->isEmpty());
    self::assertEquals(3, $files->count());
    foreach ($files as $path => $file) {
      if ($this->files->get($path)) {
        self::assertEquals(
          $this->files->get($path)->path()->absolute(),
          $file->path()->absolute()
        );
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertEquals(
      'Test 1',
      (new RegularFile($files->get("{$this->dir->path()->absolute()}/file1.test")))->content()
    );
    self::assertNull($files->get("{$this->dir->path()->absolute()}/mock.file"));
    $files = new DirectoryFilteredSetFile($this->dir, new RegExPattern('/\.test$/'));
    self::assertTrue($files->isEmpty());
    $files = new DirectoryFilteredSetFile($this->empty, new RegExPattern('/(.*)\.test$/'));
    self::assertTrue($files->isEmpty());
  }

  public function testRecursiveDirectorySetFile() {
    $files = new RecursiveDirectorySetFile($this->sandbox);
    self::assertEquals($this->sandbox->path()->absolute(), $files->directory()->path()->absolute());
    self::assertFalse($files->isEmpty());
    self::assertEquals(5, $files->count());
    foreach ($files as $path => $file) {
      $fileInPath = $this->files->get($path);
      self::assertEquals(
        $fileInPath->path()->absolute(),
        $file->path()->absolute()
      );
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertEquals('Mock', (new RegularFile($files->get("{$this->dir->path()->absolute()}/file.mock")))->content());
    self::assertNull($files->get("{$this->dir->path()->absolute()}/mock.file"));
    $files = new RecursiveDirectorySetFile($this->empty);
    self::assertTrue($files->isEmpty());
  }

  public function testRecursiveDirectoryFilteredSetFile() {
    $files = new RecursiveDirectoryFilteredSetFile($this->sandbox, new FileExtension('test'));
    self::assertEquals($this->sandbox->path()->absolute(), $files->directory()->path()->absolute());
    self::assertFalse($files->isEmpty());
    self::assertEquals(3, $files->count());
    foreach ($files as $path => $file) {
      if ($this->files->get($path)) {
        self::assertEquals(
          $this->files->get($path)->path()->absolute(),
          $file->path()->absolute()
        );
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection */
    self::assertEquals(
      'Test 1',
      (new RegularFile($files->get("{$this->dir->path()->absolute()}/file1.test")))->content()
    );
    self::assertNull($files->get("{$this->dir->path()->absolute()}/mock.file"));
    $files = new RecursiveDirectoryFilteredSetFile($this->dir, new RegExPattern('/\.test$/'));
    self::assertTrue($files->isEmpty());
    $files = new RecursiveDirectoryFilteredSetFile($this->empty, new RegExPattern('/(.*)\.test$/'));
    self::assertTrue($files->isEmpty());
  }
}

final class TestDirectorySetFile
  extends AbstractDirectorySetFile {
}
