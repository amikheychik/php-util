<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\JSON;

use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Response\AbstractResponse;

abstract class AbstractJSONResponse
  extends AbstractResponse
  implements JSONResponse {
  /** @var JSONResponse */
  private $response;

  public function __construct(JSONResponse $response) {
    parent::__construct($response);
    $this->response = $response;
  }

  public final function json(): Tree {
    return $this->response->json();
  }
}
