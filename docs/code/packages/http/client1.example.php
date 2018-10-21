<?php
declare(strict_types=1);

use Xtuple\Util\HTTP\Client\CURL\Configuration\DefaultConfiguration;
use Xtuple\Util\HTTP\Client\CURL\CURLClient;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyData;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Collection\Map\ArrayMapRequest;
use Xtuple\Util\HTTP\Request\Method\Method\GET;
use Xtuple\Util\HTTP\Request\Request\DELETERequest;
use Xtuple\Util\HTTP\Request\Request\GETRequest;
use Xtuple\Util\HTTP\Request\RequestStruct;
use Xtuple\Util\HTTP\Request\URI\URL\URLString;
use Xtuple\Util\HTTP\Request\URI\URL\URLWithQuery;

$client = new CURLClient(new DefaultConfiguration());
/** @noinspection PhpUnhandledExceptionInspection - $url is verified */ // <1>
$result = $client->send(new RequestStruct( // <2>
  new GET(),
  new URLWithQuery('http://example.com/api', [
    'sort' => 'ASC',
  ]),
  new ArraySetHeader([
    new HeaderStruct('Content-Type', 'application/json'),
  ]),
  new JSONBodyData([
    'filters' => [
      'exclusive' => true,
      'in_stock' => true,
    ],
  ])
));
try {
  $response = $result->response();
  // Returns HTTP code as integer (e.g. 200)
  $response->status()->code();
  // Returns HTTP reason as string (e.g. "OK")
  $response->status()->reason();
  // Each header may be retrieved by name; a Header type is returned, if it exists (or null otherwise)
  $response->headers()->get('Content-Type');
  // Body type extends Stream, so by default only provides a reference to a resource
  $response->body()->resource();
}
catch (Throwable $e) {
  // Handling response exception
}

/** @noinspection PhpUnhandledExceptionInspection - $requests types are verified */ // <3>
$requests = new ArrayMapRequest([
  // If request keys are not specified, integer indexes are used and casted to strings.
  'get' => new GETRequest(new URLString('http://example.com')),
  'delete' => new DELETERequest(new URLWithQuery('http://example.com/resource', ['id' => 1])),
]);
try {
  $results = $client->sendMany($requests);
  // Results may be retrieved by their key, or simply iterated
  try {
    $response = $results->get('get')->response();
    // Response can be treated the same way as if it was returned by `Client::send()`
    $response->body();
  }
  catch (Throwable $e) {
    // Handle a specific response exception.
  }
}
catch (Throwable $e) {
  // Handle generic problem occurred, that prevented requests from being sent.
}
