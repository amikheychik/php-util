<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Xtuple\Util\Exception\Collection\Sequence\ListThrowable;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ListMessage;
use Xtuple\Util\Type\String\Message\Message\Message;

interface Throwable
  extends \Throwable {
  public function message(): Message;

  public function exceptions(): ListThrowable;

  public function errors(): ?ListMessage;
}
