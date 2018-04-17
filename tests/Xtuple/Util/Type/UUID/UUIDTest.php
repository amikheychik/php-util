<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

use PHPUnit\Framework\TestCase;

class UUIDTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage String UUIDv4 is not a valid UUID
   * @throws \Throwable
   */
  public function testString() {
    $nil = new UUIDString('00000000-0000-0000-0000-000000000000');
    self::assertEquals('urn:uuid:00000000-0000-0000-0000-000000000000', $nil->urn());
    self::assertEquals('00000000-0000-0000-0000-000000000000', (string) $nil);
    $uuid = new UUIDString('a1b2c3d4-e5f6-6f5e-4d3c-2b1aA1B2C3D4');
    self::assertEquals('urn:uuid:a1b2c3d4-e5f6-6f5e-4d3c-2b1aA1B2C3D4', $uuid->urn());
    self::assertEquals('a1b2c3d4-e5f6-6f5e-4d3c-2b1aA1B2C3D4', (string) $uuid);
    $uuid1 = new UUIDString('a1b2c3d4-e5f6-6f5e-4d3c-2b1aA1B2C3D4');
    self::assertTrue($uuid->equals($uuid1));
    $uuid2 = new UUIDString('a1b2c3d4-6f5e-4d3c-e5f6-2b1aA1B2C3D4');
    self::assertFalse($uuid->equals($uuid2));
    new UUIDString('UUIDv4');
  }

  /**
   * @throws \Throwable
   */
  public function testUUIDv4() {
    $uuid1 = new UUIDv4();
    $uuid2 = new UUIDv4();
    self::assertFalse($uuid1->equals($uuid2));
    self::assertFalse($uuid1->urn() === $uuid2->urn());
    self::assertEquals('4', substr((string) $uuid1, 14, 1));
    self::assertEquals('4', substr((string) $uuid2, 14, 1));
    self::assertTrue(in_array(substr((string) $uuid1, 19, 1), ['8', '9', 'a', 'b']));
    self::assertTrue(in_array(substr((string) $uuid2, 19, 1), ['8', '9', 'a', 'b']));
  }

  /**
   * @throws \Throwable
   */
  public function testOptional() {
    $uuid = new UUIDv4();
    $optional = new OptionalUUIDString((string) $uuid);
    self::assertTrue($optional->isPresent());
    self::assertTrue($uuid->equals($optional->value()));
    $optional = new OptionalUUIDString('UUIDv4');
    self::assertFalse($optional->isPresent());
    self::assertNull($optional->value());
    $optional = new OptionalUUIDString(null);
    self::assertFalse($optional->isPresent());
    self::assertNull($optional->value());
  }
}
