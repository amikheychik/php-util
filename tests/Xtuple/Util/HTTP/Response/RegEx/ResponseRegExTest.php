<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\RegEx;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\RegEx\String\NewLineRegEx;

class ResponseRegExTest
  extends TestCase {
  public function testHTML() {
    $response = (new NewLineRegEx())->replace("\r\n", <<<EOT
HTTP/1.1 302 FOUND
Connection: keep-alive
Server: gunicorn/19.7.1
Date: Fri, 04 May 2018 21:03:31 GMT
Content-Type: text/html; charset=utf-8
Content-Length: 0
Location: /get
Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true
X-Powered-By: Flask
X-Processed-Time: 0
Via: 1.1 vegur

HTTP/1.1 200 OK
Connection: keep-alive
Server: gunicorn/19.7.1
Date: Fri, 04 May 2018 21:03:31 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true
X-Powered-By: Flask
X-Processed-Time: 0
Content-Length: 181
Via: 1.1 vegur
EOT
    );
    $matches = (new ResponseRegEx())->matches($response);
    self::assertEquals('HTTP/1.1 302 FOUND', $matches['status']);
    self::assertStringStartsWith('HTTP/1.1 200 OK', $matches['body']);
  }

  public function testJSON() {
    $response = <<<EOT
HTTP/1.1 200 OK
Server: nginx
Date: Thu, 05 Jan 2017 05:45:24 GMT
Content-Type: application/json
Content-Length: 153
Connection: keep-alive
Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true

{
  "args": {}, 
  "headers": {
    "Accept": "*/*", 
    "Host": "httpbin.org"
  }, 
  "origin": "184.179.17.76", 
  "url": "https://httpbin.org/get"
}
EOT;

    $regex = new ResponseRegEx();
    self::assertNotNull($regex->matches((new NewLineRegEx())->replace("\r\n", $response)));
  }
}
