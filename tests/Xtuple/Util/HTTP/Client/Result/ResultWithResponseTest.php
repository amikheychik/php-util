<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromString;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Response\ResponseStruct;
use Xtuple\Util\HTTP\Response\Status\StatusString;

final class ResultWithResponseTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $response = new ResponseStruct(
      new StatusString('HTTP/1.1 200 OK'),
      new ArraySetHeader(),
      new StringBodyFromString('')
    );
    $result = new ResultWithResponse('test', $response);
    self::assertEquals('test', $result->key());
    self::assertTrue($result->response() === $response);
  }
}
