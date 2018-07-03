<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Multi;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\File\Directory\Make\MakeDirectoryPath;
use Xtuple\Util\HTTP\Client\CURL\Configuration\DebugConfiguration;
use Xtuple\Util\HTTP\Client\CURL\Handle\BinaryHandle;
use Xtuple\Util\HTTP\Client\CURL\Handle\Collection\Map\ArrayMapHandle;
use Xtuple\Util\HTTP\Client\Exception\Throwable;
use Xtuple\Util\HTTP\Request\Request\DELETERequest;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLComponents;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\HTTP\Response\JSON\JSONResponseStruct;

final class MultiHandleMapHandleTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function setUp() {
    parent::setUp();
    new MakeDirectoryPath('/tmp/phpunit/http');
  }

  /**
   * @throws \Throwable
   */
  public function testLifecycle() {
    $handle = new MultiHandleMapHandle(new ArrayMapHandle([
      new BinaryHandle(
        'get',
        new GETRequest(new URLString('http://httpbin.org/image/png')),
        new DebugConfiguration()
      ),
      new BinaryHandle(
        'redirect',
        new GETRequest(new URLString('https://httpbin.org/redirect/3')),
        new DebugConfiguration()
      ),
      new BinaryHandle(
        'delete',
        new DELETERequest(new URLString('https://httpbin.org/delete')),
        new DebugConfiguration()
      ),
    ]));
    $results = $handle->execute();
    $response = $results->get('get')->response();
    self::assertEquals(200, $response->status()->code());
    self::assertEquals('OK', $response->status()->reason());
    self::assertEquals('image/png', $response->headers()->get('Content-Type')->value());
    $png = '/tmp/phpunit/http/image-multi.png';
    $copy = fopen($png, 'w+');
    stream_copy_to_stream($response->body()->resource(), $copy);
    fclose($copy);
    self::assertEquals('image/png', getimagesize($png)['mime']);
    unlink($png);
    self::assertEquals(
      'https://httpbin.org/get',
      (new JSONResponseStruct($results->get('redirect')->response()))->json()->get(['url'])
    );
    self::assertEquals(
      'https://httpbin.org/delete',
      (new JSONResponseStruct($results->get('delete')->response()))->json()->get(['url'])
    );
  }

  /**
   * @throws \Throwable
   */
  public function testResultWithThrowable() {
    $handle = new MultiHandleMapHandle(new ArrayMapHandle([
      new BinaryHandle(
        'get',
        new GETRequest(new URLString('http://httpbin.org/image/png')),
        new DebugConfiguration()
      ),
      new BinaryHandle(
        'fail',
        new GETRequest(new URLComponents(['scheme' => 'https', 'host' => '\\'])),
        new DebugConfiguration()
      ),
    ]));
    $results = $handle->execute();
    $this->expectException(Throwable::class);
    $results->get('fail')->response();
  }
}
