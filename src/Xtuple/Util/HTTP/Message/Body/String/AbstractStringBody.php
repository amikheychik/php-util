<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use Xtuple\Util\HTTP\Message\Body\AbstractBody;

abstract class AbstractStringBody
  extends AbstractBody
  implements StringBody {
  /** @var StringBody */
  private $body;

  public function __construct(StringBody $body) {
    parent::__construct($body);
    $this->body = $body;
  }

  public final function __toString(): string {
    return $this->body->__toString();
  }

  public final function content(): string {
    return $this->body->content();
  }
}
