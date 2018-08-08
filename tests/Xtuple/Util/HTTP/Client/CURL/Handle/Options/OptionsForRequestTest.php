<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Client\CURL\Configuration\ConfigurationStruct;
use Xtuple\Util\HTTP\Client\CURL\Configuration\DebugConfiguration;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\Header\ContentType\JSONContentTypeHeader;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\Type\Stream\StreamStruct;

final class OptionsForRequestTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $header = tmpfile();
    $body = tmpfile();
    $options = new OptionsForRequest(
      new GETRequest(new URLString('http://example.com'), new ArraySetHeader([
        new JSONContentTypeHeader(),
      ])),
      new DebugConfiguration(new ConfigurationStruct(false, 60.0)),
      new StreamStruct($header),
      new StreamStruct($body)
    );
    /** @noinspection CurlSslServerSpoofingInspection - testing values */
    self::assertEquals([
      CURLOPT_TIMEOUT => 60.0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_URL => 'http://example.com',
      CURLOPT_POSTFIELDS => '',
      CURLOPT_HTTPHEADER => [
        'Expect: ',
        'Content-Type: application/json',
      ],
      CURLOPT_RETURNTRANSFER => false,
      CURLOPT_HEADER => false,
      CURLOPT_WRITEHEADER => $header,
      CURLOPT_FILE => $body,
    ], $options->options());
  }
}
