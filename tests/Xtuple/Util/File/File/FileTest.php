<?php declare(strict_types=1);

namespace Xtuple\Util\File\File;

use PHPUnit\Framework\TestCase;

class FileTest
  extends TestCase {
  /**
   * @expectedException \Xtuple\Util\Exception\Exception
   * @expectedExceptionMessage File ./FileTest.php not found
   */
  public function testSplInfo() {
    $file = new FileSplFileInfo(new \SplFileInfo(__FILE__));
    self::assertEquals(__FILE__, $file->path()->absolute());
    self::assertEquals('FileTest.php', $file->name());
    self::assertEquals(filemtime(__FILE__), $file->modified());
    new FileSplFileInfo(new \SplFileInfo('./FileTest.php'));
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Exception
   * @expectedExceptionMessage File ./FileTest.php not found
   */
  public function testFromPathString() {
    $file = new FileFromPathString(__FILE__);
    self::assertEquals(__FILE__, $file->path()->absolute());
    self::assertEquals('FileTest.php', $file->name());
    self::assertEquals(filemtime(__FILE__), $file->modified());
    new FileFromPathString('./FileTest.php');
  }
}
