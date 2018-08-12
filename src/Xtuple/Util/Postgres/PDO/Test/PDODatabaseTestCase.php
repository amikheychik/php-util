<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test;

use Xtuple\Util\Postgres\PDO\Test\Environment\Configuration\Configuration;
use Xtuple\Util\Postgres\PDO\Test\Environment\Environment;
use Xtuple\Util\Postgres\PDO\Test\Environment\EnvironmentStruct;
use Xtuple\Util\Test\AbstractTestCase;

/**
 * @property Environment $environment
 */
abstract class PDODatabaseTestCase
  extends AbstractTestCase {
  protected function environmentName(): string {
    return 'Postgres';
  }

  protected function configurationType(): string {
    return Configuration::class;
  }

  protected function setUpEnvironment($configuration) {
    return new EnvironmentStruct($configuration);
  }
}
