<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client;

use Xtuple\Util\HTTP\Client\Result\Collection\Map\MapResult;
use Xtuple\Util\HTTP\Client\Result\Result;
use Xtuple\Util\HTTP\Request\Collection\Map\MapRequest;
use Xtuple\Util\HTTP\Request\Request;

abstract class AbstractClient
  implements Client {
  /** @var Client */
  private $client;

  public function __construct(Client $client) {
    $this->client = $client;
  }

  public final function send(Request $request): Result {
    return $this->client->send($request);
  }

  public final function sendMany(MapRequest $requests): MapResult {
    return $this->client->sendMany($requests);
  }
}
