<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\HTTP\Client\CURL\Configuration\DebugConfiguration;
use Xtuple\Util\HTTP\Client\Exception\Throwable;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;

final class BinaryHandleTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  protected function setUp() {
    parent::setUp();
    new MakeDirectoryPath('/tmp/phpunit/http');
  }

  /**
   * @throws \Throwable
   */
  public function testHandle() {
    $handle = new BinaryHandle(
      'test',
      new GETRequest(
        new URLString('http://httpbin.org/image/png')
      ),
      new DebugConfiguration()
    );
    $response = $handle->response();
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('image/png', $response->headers()->get('Content-Type')->value());
    $png = '/tmp/phpunit/http/image.png';
    $copy = fopen($png, 'w+');
    stream_copy_to_stream($response->body()->resource(), $copy);
    fclose($copy);
    self::assertEquals('image/png', getimagesize($png)['mime']);
    unlink($png);
  }

  /**
   * @throws \Throwable
   */
  public function testException() {
    $handle = new BinaryHandle(
      'test',
      new GETRequest(new URLString('http://httpbin.org/get')),
      new DebugConfiguration()
    );
    curl_setopt($handle->handle(), CURLOPT_URL, 'http://\\');
    error_reporting(E_ERROR);
    $this->expectException(Throwable::class);
    $handle->response();
  }
}
