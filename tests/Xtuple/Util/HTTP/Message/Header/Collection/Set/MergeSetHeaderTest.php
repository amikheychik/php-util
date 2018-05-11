<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;

class MergeSetHeaderTest
  extends TestCase {
  public function testMerge() {
    /** @noinspection PhpUnhandledExceptionInspection - $headers types are verified */
    $merged = new MergeSetHeader(new ArraySetHeader([
      new HeaderStruct('Keywords', 'HTTP'),
    ]), new ArraySetHeader([
      new HeaderStruct('Keywords', 'HTTPS'),
      new HeaderStruct('Description', 'Hypertext Transfer Protocol'),
    ]), new ArraySetHeader([
      new HeaderStruct('Keywords', 'FTP'),
      new HeaderStruct('Description', 'File Transfer Protocol'),
      new HeaderStruct('Content-Type', 'application/octet-stream'),
    ]));
    self::assertEquals(3, $merged->count());
    self::assertEquals(
      'Keywords: HTTP, HTTPS, FTP',
      $merged->get('Keywords')
    );
    self::assertEquals(
      'Description: Hypertext Transfer Protocol, File Transfer Protocol',
      (string) $merged->get('Description')
    );
  }
}
