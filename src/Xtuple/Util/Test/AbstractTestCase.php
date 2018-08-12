<?php declare(strict_types=1);

namespace Xtuple\Util\Test;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Test\Environment\Configuration\Collection\Map\MapConfiguration;

abstract class AbstractTestCase
  extends TestCase {
  /** @var mixed */
  protected $environment;

  protected abstract function environmentName(): string;

  protected abstract function configurationType(): string;

  /**
   * @generic
   *
   * @throws \Throwable
   *
   * @param mixed $configuration
   *
   * @return mixed
   */
  protected abstract function setUpEnvironment($configuration);

  protected function setUp() {
    parent::setUp();
    if (empty($GLOBALS['PHPUNIT_ENVIRONMENT'])) {
      self::markTestSkipped('Undefined PHPUNIT_ENVIRONMENT');
    }
    try {
      /** @var MapConfiguration $configuration */
      $configuration = new $GLOBALS['PHPUNIT_ENVIRONMENT']();
      if ($config = $configuration->get($this->configurationType())) {
        $this->environment = $this->setUpEnvironment($config);
      }
    }
    catch (\Throwable $e) {
      self::markTestSkipped($e->getMessage());
    }
    if ($this->environment === null) {
      self::markTestSkipped(strtr('{environment} is not set up.', [
        '{environment}' => $this->environmentName(),
      ]));
    }
  }
}
