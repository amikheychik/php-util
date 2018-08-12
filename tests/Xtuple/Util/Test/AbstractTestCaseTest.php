<?php declare(strict_types=1);

namespace Xtuple\Util\Test;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Exception;

class AbstractTestCaseTest
  extends TestCase {
  public function testEnvironmentNotSetupException() {
    $test = new TestAbstractTestCase('testSetup');
    try {
      $test->runTest();
    }
    catch (\Throwable $e) {
      self::assertEquals('Test is not set up.', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to assert that test is not set up.');
      }
    }
  }

  public function testUndefinedEnvironmentException() {
    $test = new TestAbstractTestCase('testSetup');
    $value = $GLOBALS['PHPUNIT_ENVIRONMENT'];
    try {
      unset($GLOBALS['PHPUNIT_ENVIRONMENT']);
      $test->runTest();
    }
    catch (\Throwable $e) {
      self::assertEquals('Undefined PHPUNIT_ENVIRONMENT', $e->getMessage());
    }
    finally {
      $GLOBALS['PHPUNIT_ENVIRONMENT'] = $value;
      if (!isset($e)) {
        self::fail('Failed to assert that PHPUNIT_ENVIRONMENT is not set.');
      }
    }
  }

  public function testEnvironmentSetupException() {
    $test = new TestAbstractTestCase('testSetup');
    $value = $GLOBALS['PHPUNIT_ENVIRONMENT'];
    try {
      $GLOBALS['PHPUNIT_ENVIRONMENT'] = FailedEnvironment::class;
      $test->runTest();
    }
    catch (\Throwable $e) {
      self::assertEquals('Failed to create environment', $e->getMessage());
    }
    finally {
      $GLOBALS['PHPUNIT_ENVIRONMENT'] = $value;
      if (!isset($e)) {
        self::fail('Failed to assert that environment creation failed.');
      }
    }
  }
}

final class TestAbstractTestCase
  extends AbstractTestCase {
  public function testSetup() {
    $this->setUp();
  }

  protected function environmentName(): string {
    return 'Test';
  }

  protected function configurationType(): string {
    return 'test';
  }

  protected function setUpEnvironment($configuration) {
    return null;
  }
}

final class FailedEnvironment {
  /**
   * @throws \Throwable
   */
  public function __construct() {
    throw new Exception('Failed to create environment');
  }
}
