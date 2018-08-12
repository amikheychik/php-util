<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Test;

use PHPUnit\Framework\TestCase;

class PDODatabaseTestCaseTest
  extends TestCase {
  public function testEnvironmentNotSetupException() {
    $test = new TestPDODatabaseTestCase('testSetup');
    try {
      $test->runTest();
    }
    catch (\Throwable $e) {
      self::assertEquals('Postgres is not set up.', $e->getMessage());
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed to assert that environment is not set up.');
      }
    }
  }
}

final class TestPDODatabaseTestCase
  extends PDODatabaseTestCase {
  public function testSetup() {
    $this->setUp();
  }

  /** @noinspection PhpMissingParentCallCommonInspection */
  protected function setUpEnvironment($configuration) {
    return null;
  }
}
