<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Header\Exception\HeaderMergeException;

final class MergeHeaderTest
  extends TestCase {
  public function testMerge() {
    /** @noinspection PhpUnhandledExceptionInspection - header names are the same */
    $merged = new MergeHeader(
      new HeaderStruct('Keywords', 'HTTP'),
      new HeaderStruct('Keywords', 'HTTPS'),
      new HeaderStruct('Keywords', 'FTP')
    );
    self::assertEquals('Keywords: HTTP, HTTPS, FTP', (string) $merged);
    self::assertEquals('Keywords', $merged->name());
    self::assertEquals('HTTP, HTTPS, FTP', $merged->value());
  }

  /**
   * @throws \Throwable
   */
  public function testMergeException() {
    $this->expectException(HeaderMergeException::class);
    $this->expectExceptionMessage('Header Keywords can not be merged with header Description');
    new MergeHeader(...[
      new HeaderStruct('Keywords', 'HTTP'),
      new HeaderStruct('Description', 'Hypertext Transfer Protocol'),
    ]);
  }
}
