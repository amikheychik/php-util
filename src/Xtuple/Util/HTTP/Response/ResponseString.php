<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromString;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeaderFromString;
use Xtuple\Util\HTTP\Response\Exception\ResponseParsingException;
use Xtuple\Util\HTTP\Response\RegEx\ResponseRegEx;
use Xtuple\Util\HTTP\Response\Status\StatusString;

final class ResponseString
  extends AbstractResponse {
  /**
   * @throws ResponseParsingException
   *
   * @param string $response
   */
  public function __construct(string $response) {
    $regex = new ResponseRegEx();
    $matches = $regex->matches($response);
    if (empty($matches)) {
      throw new ResponseParsingException();
    }
    while ($redirect = $regex->matches($matches['body'])) {
      $matches = $redirect;
    }
    /** @noinspection PhpUnhandledExceptionInspection - status is parsed by ResponseRegEx */
    parent::__construct(new ResponseStruct(
      new StatusString($matches['status']),
      new ArraySetHeaderFromString($matches['headers']),
      new StringBodyFromString($matches['body'])
    ));
  }
}
