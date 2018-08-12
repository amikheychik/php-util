<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration;

use Xtuple\Util\Postgres\PDO\Test\Environment\Configuration\ConfigurationXMLElement as PostgresConfigurationXMLElement;
use Xtuple\Util\Test\Environment\Configuration\Collection\Map\AbstractMapConfiguration;

final class EnvironmentXMLMapConfiguration
  extends AbstractMapConfiguration {
  /**
   * @throws \Throwable
   */
  public function __construct() {
    parent::__construct(
      new PHPUnitEnvironmentXMLConfiguration([
        'postgres' => PostgresConfigurationXMLElement::class,
      ])
    );
  }
}
