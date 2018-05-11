<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use Xtuple\Util\HTTP\Message\Body\AbstractBody;
use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;

final class StringBodyFromBody
  extends AbstractBody
  implements StringBody {
  /** @var Body */
  private $body;

  public function __construct(Body $body) {
    parent::__construct($body);
    $this->body = new StringStreamStruct($body);
  }

  public function __toString(): string {
    return (string) $this->body;
  }

  public function content(): string {
    return $this->body->content();
  }
}
