<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Date;

use Xtuple\Util\Type\String\Message\Message\AbstractMessage;

abstract class AbstractDateTimeMessage
  extends AbstractMessage
  implements DateTimeMessage {
  /** @var DateTimeMessage */
  private $date;

  public function __construct(DateTimeMessage $date) {
    parent::__construct($date);
    $this->date = $date;
  }

  public final function timezone(?string $timezone = null): string {
    return $this->date->timezone($timezone);
  }
}
