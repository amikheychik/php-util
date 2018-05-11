<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\BodyStream;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Response\Status\StatusString;

final class ResponseStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $status = new StatusString('HTTP/1.1 200 OK');
    $headers = new ArraySetHeader([
      new HeaderStruct('Content-Type', 'application/json'),
    ]);
    $body = new BodyStream(tmpfile());
    $response = new ResponseStruct($status, $headers, $body);
    self::assertTrue($response->status() === $status);
    self::assertTrue($response->headers() === $headers);
    self::assertTrue($response->body() === $body);
  }
}
