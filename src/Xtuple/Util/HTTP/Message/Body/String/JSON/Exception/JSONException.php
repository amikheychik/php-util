<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON\Exception;

use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class JSONException
  extends AbstractJSONThrowable {
  public function __construct(?\Throwable $previous = null) {
    parent::__construct(
      new StringMessage(json_last_error_msg()),
      $previous,
      null,
      json_last_error()
    );
  }
}
