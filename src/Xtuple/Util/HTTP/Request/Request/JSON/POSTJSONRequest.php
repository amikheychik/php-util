<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Request\JSON;

use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBody;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\MergeSetHeader;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\AbstractRequest;
use Xtuple\Util\HTTP\Request\Request\POSTRequest;
use Xtuple\Util\HTTP\Request\URI\URI;

final class POSTJSONRequest
  extends AbstractRequest {
  public function __construct(URI $uri, JSONBody $body, ?SetHeader $headers = null) {
    /** @noinspection PhpUnhandledExceptionInspection - $headers is empty */
    $headers = $headers ?: new ArraySetHeader();
    /** @noinspection PhpUnhandledExceptionInspection - $headers types are verified */
    $defaults = new ArraySetHeader([
      new HeaderStruct('Content-Type', 'application/json'),
    ]);
    parent::__construct(new POSTRequest(
      $uri,
      new MergeSetHeader($headers, $defaults),
      $body
    ));
  }
}
