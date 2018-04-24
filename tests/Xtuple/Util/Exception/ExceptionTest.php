<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ArrayListMessage;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;

class ExceptionTest
  extends TestCase {
  /** @var string */
  private $file;

  public function __construct(?string $name = null, array $data = [], string $dataName = '') {
    parent::__construct($name, $data, $dataName);
    $this->file = __FILE__;
  }

  public function testException() {
    $e = new Exception('Test {exception}', [
      'exception' => 'throwable',
    ]);
    self::assertEquals('Test throwable', $e->getMessage());
    self::assertEquals('Test {exception}', $e->message()->template());
    self::assertEquals('throwable', $e->message()->arguments()->get('exception'));
    self::assertEquals(
      "Xtuple\\Util\\Exception\\Exception: Test throwable in {$this->file}:23",
      $e->__toString()
    );
  }

  /**
   * @throws \Throwable
   */
  public function testExceptionWithArguments() {
    $e = new ExceptionWithMessage(new MessageStruct('Test {exception}', new ArrayMapArgument([
      new StringArgument('exception', 'throwable'),
    ])));
    self::assertEquals('Test throwable', $e->getMessage());
    self::assertEquals('Test {exception}', $e->message()->template());
    self::assertEquals('throwable', $e->message()->arguments()->get('exception'));
  }

  /**
   * @throws \Throwable
   */
  public function testExceptionWithMessage() {
    $e = new ExceptionWithMessage(new MessageStruct('Test {exception}', new ArrayMapArgument([
      new StringArgument('exception', 'throwable'),
    ])));
    self::assertEquals('Test throwable', $e->getMessage());
    self::assertEquals('Test {exception}', $e->message()->template());
    self::assertEquals('throwable', $e->message()->arguments()->get('exception'));
  }

  /**
   * @throws \Throwable
   */
  public function testChained() {
    $e = new Exception('Test {exception}', [
      'exception' => 'throwable',
    ]);
    $e = new ExceptionWithArguments('Test {exception}', new ArrayMapArgument([
      new StringArgument('exception', 'previous'),
    ]), $e, null, 403);
    $e = new ExceptionWithMessage(new MessageStruct('Test http error {http}', new ArrayMapArgument([
      new StringArgument('http', 'page not found'),
    ])), $e, null, 404);
    self::assertEquals('Test http error page not found', $e->getMessage());
    self::assertEquals('Test http error {http}', $e->message()->template());
    self::assertEquals('page not found', $e->message()->arguments()->get('http'));
    self::assertEquals(404, $e->getCode());
    $e = new ChainException($e, 'Test chained {exception}', [
      'exception' => 'exception',
    ]);
    self::assertEquals('Test chained exception', $e->getMessage());
    self::assertEquals('Test chained {exception}', $e->message()->template());
    self::assertEquals('exception', $e->message()->arguments()->get('exception'));
    self::assertEquals(implode("\n", [
      "Xtuple\\Util\\Exception\\ChainException: Test chained exception in {$this->file}:76",
      "\t+ Xtuple\\Util\\Exception\\ExceptionWithMessage:404 Test http error page not found in {$this->file}:69",
      "\t\t+ Xtuple\\Util\\Exception\\ExceptionWithArguments:403 Test previous in {$this->file}:66",
      "\t\t\t+ Xtuple\\Util\\Exception\\Exception: Test throwable in {$this->file}:63",
    ]), $e->__toString());
  }

  /**
   * @throws \Throwable
   */
  public function testMultiple() {
    $e = new MultiErrorException([
      new MessageWithTokens('HTTP request to URL {url} failed', [
        'url' => 'http://httpbin.org',
      ]),
      new MessageWithTokens('HTTP request to URL {url} failed', [
        'url' => 'http://example.com',
      ]),
    ], 'Async requests failed for {url}', [
      'url' => 'http://httpbin.org',
    ]);
    $e = new ChainException($e, 'API request failed', [], new ArrayListMessage([
      new MessageWithTokens('Failed {count} requests', [
        'count' => $e->errors()->count(),
      ]),
    ]));
    self::assertEquals(implode("\n", [
      "Xtuple\\Util\\Exception\\ChainException: API request failed in {$this->file}:104",
      "\t- Failed 2 requests",
      "\t+ Xtuple\\Util\\Exception\\MultiErrorException: Async requests failed for http://httpbin.org in {$this->file}:94",
      "\t\t- HTTP request to URL http://httpbin.org failed",
      "\t\t- HTTP request to URL http://example.com failed",
    ]), $e->__toString());
  }

  public function testLastError() {
    $e = new LastErrorException('Last error');
    self::assertEquals('Last error', $e->getMessage());
    $previous = error_reporting(E_ERROR);
    trigger_error('Test user warning', E_USER_WARNING);
    $e = new LastErrorException('Last error');
    self::assertEquals('Last error: Test user warning', $e->getMessage());
    error_reporting($previous);
  }
}
