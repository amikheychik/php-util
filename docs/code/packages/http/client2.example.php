<?php
declare(strict_types=1);

use Xtuple\Util\HTTP\Client\CURL\Configuration\DefaultConfiguration;
use Xtuple\Util\HTTP\Client\CURL\CURLClient;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\Request\JSON\POSTJSONRequest;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\AbstractBaseURL;
use Xtuple\Util\HTTP\Request\URI\URL\AbstractURL;
use Xtuple\Util\HTTP\Response\JSON\AbstractJSONResponse;
use Xtuple\Util\HTTP\Response\JSON\JSONResponseStruct;
use Xtuple\Util\HTTP\Response\Response;

// A base URL for a service, allows to provide a specific path with a query and a fragment
final class ExampleURL
  extends AbstractBaseURL {
  public function __construct(string $path, array $query = [], string $fragment = '') {
    parent::__construct('http://example.com', $path, $query, $fragment);
  }
}

// Concrete URL for a service, may be used not only to specify the URL, but to request different parameters.
final class ProductsExampleURL
  extends AbstractURL {
  public function __construct(string $sort = 'title') {
    /** @noinspection PhpUnhandledExceptionInspection - $url is verified */
    parent::__construct(new ExampleURL('products', [
      'sort' => $sort,
    ]));
  }
}

// Concrete Request class to retrieve products
final class GETExampleProductsRequest
  extends AbstractRequest {
  public function __construct(string $sort = 'title') {
    parent::__construct(new GETRequest(
      new ProductsExampleURL($sort)
    ));
  }
}

// Concrete Request class to create a product:
// encapsulating all the information of how to send info,
// exposing only parameters required by the API
final class POSTProductRequest
  extends AbstractRequest {
  public function __construct(string $title, string $subTitle) {
    /** @noinspection PhpUnhandledExceptionInspection - $headers types are verified */
    parent::__construct(new RequestStruct(
      new POST(),
      new ProductsExampleURL(),
      new ArraySetHeader([
        new HeaderStruct('Content-Type', 'application/json'),
      ]),
      new JSONBodyData([
        'title' => $title,
        'subTitle' => $subTitle,
      ])
    ));
  }
}

// Alternative implementation, using POSTJSONRequest class, to simplify passing headers.
final class POSTJSONProductRequest
  extends AbstractRequest {
  public function __construct(string $title, string $subTitle) {
    parent::__construct(new POSTJSONRequest(
      new ProductsExampleURL(),
      new JSONBodyData([
        'title' => $title,
        'subTitle' => $subTitle,
      ])
    ));
  }
}

// Concrete class to handle a generic response for POSTJSONProductRequest (or POSTProductRequest)
final class POSTProductJSONResponse
  extends AbstractJSONResponse {
  public function __construct(Response $response) {
    parent::__construct(new JSONResponseStruct($response));
  }
}

// Final code to send and handle the request contains only the necessary in the context information
$client = new CURLClient(new DefaultConfiguration());
try {
  $response = new POSTProductJSONResponse(
    $client->send(new POSTJSONProductRequest('Example', 'A very good product'))->response()
  );
  // JSON data is available for work
  $response->json();
}
catch (Throwable $e) {
  // Handle request or JSON errors
}
