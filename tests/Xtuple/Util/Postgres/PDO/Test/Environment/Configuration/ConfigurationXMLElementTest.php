<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test\Environment\Configuration;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\XML\Element\XMLElementString;

class ConfigurationXMLElementTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $element = new XMLElementString(
      '<postgres host="localhost" port="5432" database="phpunit" username="phpunit" password="phpunit"/>'
    );
    $configuration = new class (new ConfigurationXMLElement($element))
      extends AbstractConfiguration {
    };
    self::assertEquals(
      'pgsql:host=localhost;port=5432;dbname=phpunit;user=phpunit;password=phpunit',
      $configuration->postgres()->dsn()
    );
  }
}
