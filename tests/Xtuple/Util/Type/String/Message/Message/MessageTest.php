<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Argument\ArgumentStruct;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Type\Plural\PluralArgumentFromStrings;
use Xtuple\Util\Type\String\Message\Type\Select\SelectArgumentFromStrings;
use Xtuple\Util\Type\String\Message\Type\Select\SelectArgumentStruct;
use Xtuple\Util\Type\String\Message\Type\Select\SelectMessageStruct;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;

class MessageTest
  extends TestCase {
  public function testStruct() {
    $message = new MessageStruct('Query {query} failed: {message}', new ArraySetArgument([
      new StringArgument('query', 'http://httpbin.org/status/404'),
      new StringArgument('message', 'Page not found'),
    ]));
    self::assertEquals('Query http://httpbin.org/status/404 failed: Page not found', $message->__toString());
    self::assertEquals('Query {query} failed: {message}', $message->template());
  }

  public function testPlurals() {
    $count = 0;
    $message = new MessageStruct('CSV file {file} uploaded: {lines} processed.', new ArraySetArgument([
      new StringArgument('file', 'example.csv'),
      new PluralArgumentFromStrings('lines', $count, '{count} lines', '1 line', [
        '=0' => 'no lines',
      ]),
    ]));
    self::assertEquals('CSV file example.csv uploaded: no lines processed.', $message->__toString());
    $count = 1;
    $message = new MessageStruct('CSV file {file} uploaded: {lines} processed.', new ArraySetArgument([
      new StringArgument('file', 'example.csv'),
      new PluralArgumentFromStrings('lines', $count, '{count} lines', '1 line', [
        '=0' => 'no lines',
      ]),
    ]));
    self::assertEquals('CSV file example.csv uploaded: 1 line processed.', $message->__toString());
    $count = 10;
    $message = new MessageStruct('CSV file {file} uploaded: {lines} processed.', new ArraySetArgument([
      new StringArgument('file', 'example.csv'),
      new PluralArgumentFromStrings('lines', $count, '{count} lines', '1 line', [
        '=0' => 'no lines',
      ]),
    ]));
    self::assertEquals('CSV file example.csv uploaded: 10 lines processed.', $message->__toString());
  }

  public function testPluralsArgs() {
    $codes = [];
    $message = new MessageStruct('{discounts} applied.', new ArraySetArgument([
      new PluralArgumentFromStrings('discounts', sizeof($codes), 'Discounts {codes}', 'Discount {codes}', [
        '=0' => 'No discounts',
      ], new ArraySetArgument([
        new StringArgument('codes', implode(', ', $codes)),
      ])),
    ]));
    self::assertEquals('No discounts applied.', $message->__toString());
    $codes = ['DOLLAROFF'];
    $message = new MessageStruct('{discounts} applied.', new ArraySetArgument([
      new PluralArgumentFromStrings('discounts', sizeof($codes), 'Discounts {codes}', 'Discount {codes}', [
        '=0' => 'No discounts',
      ], new ArraySetArgument([
        new StringArgument('codes', implode(', ', $codes)),
      ])),
    ]));
    self::assertEquals('Discount DOLLAROFF applied.', $message->__toString());
    $codes = ['DOLLAROFF', 'ONEFREE'];
    $message = new MessageStruct('{discounts} applied.', new ArraySetArgument([
      new PluralArgumentFromStrings('discounts', sizeof($codes), 'Discounts {codes}', 'Discount {codes}', [
        '=0' => 'No discounts',
      ], new ArraySetArgument([
        new StringArgument('codes', implode(', ', $codes)),
      ])),
    ]));
    self::assertEquals('Discounts DOLLAROFF, ONEFREE applied.', $message->__toString());
  }

  public function testSelect() {
    $option = 'other';
    $extension = '';
    $message = new MessageStruct('File with {article} uploaded.', new ArraySetArgument([
      new SelectArgumentFromStrings('article', $option, 'an unknown extension', [
        'a' => 'a {extension} extension',
        'an' => 'an {extension} extension',
      ], new ArraySetArgument([
        new StringArgument('extension', $extension),
      ])),
    ]));
    self::assertEquals('File with an unknown extension uploaded.', $message->__toString());
    $option = 'a';
    $extension = 'CSV';
    $message = new MessageStruct('File with {article} uploaded.', new ArraySetArgument([
      new SelectArgumentFromStrings('article', $option, 'an unknown extension', [
        'a' => 'a {extension} extension',
        'an' => 'an {extension} extension',
      ], new ArraySetArgument([
        new StringArgument('extension', $extension),
      ])),
    ]));
    self::assertEquals('File with a CSV extension uploaded.', $message->__toString());
    $option = 'an';
    $extension = 'XLS';
    $message = new MessageStruct('File with {article} uploaded.', new ArraySetArgument([
      new SelectArgumentFromStrings('article', $option, 'an unknown extension', [
        'a' => 'a {extension} extension',
        'an' => 'an {extension} extension',
      ], new ArraySetArgument([
        new StringArgument('extension', $extension),
      ])),
    ]));
    self::assertEquals('File with an XLS extension uploaded.', $message->__toString());
  }

  public function testComplex() {
    self::assertEquals(
      'Mickey and Minnie do not give a party.',
      (string) new TestComplexMessage('Mickey and Minnie', 'Donald', 0, 'other')
    );
    self::assertEquals(
      'Mickey and Minnie invite Donald to their party.',
      (string) new TestComplexMessage('Mickey and Minnie', 'Donald', 1, 'other')
    );
    self::assertEquals(
      'Mickey and Minnie invite Donald and one other person to their party.',
      (string) new TestComplexMessage('Mickey and Minnie', 'Donald', 2, 'other')
    );
    self::assertEquals(
      'Mickey and Minnie invite Donald and 2 other people to their party.',
      (string) new TestComplexMessage('Mickey and Minnie', 'Donald', 3, 'other')
    );
    self::assertEquals(
      'Mickey does not give a party.',
      (string) new TestComplexMessage('Mickey', 'Minnie', 0, 'male')
    );
    self::assertEquals(
      'Mickey invites Minnie to his party.',
      (string) new TestComplexMessage('Mickey', 'Minnie', 1, 'male')
    );
    self::assertEquals(
      'Mickey invites Minnie and one other person to his party.',
      (string) new TestComplexMessage('Mickey', 'Minnie', 2, 'male')
    );
    self::assertEquals(
      'Mickey invites Minnie and 2 other people to his party.',
      (string) new TestComplexMessage('Mickey', 'Minnie', 3, 'male')
    );
    self::assertEquals(
      'Minnie does not give a party.',
      (string) new TestComplexMessage('Minnie', 'Mickey', 0, 'female')
    );
    self::assertEquals(
      'Minnie invites Mickey to her party.',
      (string) new TestComplexMessage('Minnie', 'Mickey', 1, 'female')
    );
    self::assertEquals(
      'Minnie invites Mickey and one other person to her party.',
      (string) new TestComplexMessage('Minnie', 'Mickey', 2, 'female')
    );
    self::assertEquals(
      'Minnie invites Mickey and 2 other people to her party.',
      (string) new TestComplexMessage('Minnie', 'Mickey', 3, 'female')
    );
  }
}

/**
 * @see http://userguide.icu-project.org/formatparse/messages
 */
final class TestComplexMessage
  extends AbstractMessage {
  public function __construct(string $host, string $guest, int $people, string $option) {
    parent::__construct(new MessageStruct('{party}', new ArraySetArgument([
      new SelectArgumentStruct('party', new SelectMessageStruct(
        $option,
        new PluralArgumentFromStrings(
          'guests',
          $people,
          '{host} invite {guest} and {count} other people to their party.',
          '',
          [
            '=0' => '{host} do not give a party.',
            '=1' => '{host} invite {guest} to their party.',
            '=2' => '{host} invite {guest} and one other person to their party.',
          ],
          null,
          1
        ),
        new ArraySetArgument([
          new ArgumentStruct('female', new MessageStruct('{guests}', new ArraySetArgument([
            new PluralArgumentFromStrings(
              'guests',
              $people,
              '{host} invites {guest} and {count} other people to her party.',
              '{host} invites {guest} to her party.',
              [
                '=0' => '{host} does not give a party.',
                '=1' => '{host} invites {guest} to her party.',
                '=2' => '{host} invites {guest} and one other person to her party.',
              ],
              null,
              1
            ),
          ]))),
          new ArgumentStruct('male', new MessageStruct('{guests}', new ArraySetArgument([
            new PluralArgumentFromStrings(
              'guests',
              $people,
              '{host} invites {guest} and {count} other people to his party.',
              '{host} invites {guest} to his party.',
              [
                '=0' => '{host} does not give a party.',
                '=1' => '{host} invites {guest} to his party.',
                '=2' => '{host} invites {guest} and one other person to his party.',
              ],
              null,
              1
            ),
          ]))),
        ]),
        new ArraySetArgument([
          new StringArgument('host', $host),
          new StringArgument('guest', $guest),
        ])
      )),
    ])));
  }
}
