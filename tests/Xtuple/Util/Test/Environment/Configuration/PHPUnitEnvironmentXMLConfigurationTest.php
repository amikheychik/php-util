<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration;

use PHPUnit\Framework\TestCase;

class PHPUnitEnvironmentXMLConfigurationTest
  extends TestCase {
  public function testConstructorException() {
    $value = $GLOBALS['PHPUNIT_ENVIRONMENT_XML_CONFIGURATION'];
    unset($GLOBALS['PHPUNIT_ENVIRONMENT_XML_CONFIGURATION']);
    try {
      new PHPUnitEnvironmentXMLConfiguration();
    }
    catch (\Throwable $e) {
      self::assertEquals('Undefined PHPUNIT_ENVIRONMENT_XML_CONFIGURATION', $e->getMessage());
    }
    finally {
      $GLOBALS['PHPUNIT_ENVIRONMENT_XML_CONFIGURATION'] = $value;
      if (!isset($e)) {
        self::fail('Failed to assert that exception is thrown');
      }
    }
  }
}
