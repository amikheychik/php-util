<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment\Configuration;

use Xtuple\Util\Postgres\PDO\Connection\Connection;
use Xtuple\Util\Postgres\PDO\Connection\ConnectionXMLElement;
use Xtuple\Util\XML\Element\XMLElement;

final class ConfigurationXMLElement
  implements Configuration {
  /** @var XMLElement */
  private $element;

  public function __construct(XMLElement $element) {
    $this->element = $element;
  }

  public function postgres(): Connection {
    return new ConnectionXMLElement($this->element);
  }
}
