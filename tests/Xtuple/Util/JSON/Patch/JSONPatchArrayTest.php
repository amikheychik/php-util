<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch;

use PHPUnit\Framework\TestCase;

final class JSONPatchArrayTest
  extends TestCase {
  public function testAdd() {
    $patch = new JSONPatchArray([], [
      'add' => 'added',
    ]);
    $patch = new class ($patch) extends AbstractJSONPatch {};
    self::assertEquals('[{"op":"add","path":"\/add","value":"added"}]', json_encode($patch));
  }

  public function testRemove() {
    $patch = new JSONPatchArray([
      'remove' => 'value1',
      'remain' => 'value2',
    ], [
      'remain' => 'value2',
    ]);
    $patch = new class ($patch) extends AbstractJSONPatch {};
    self::assertEquals('[{"op":"remove","path":"\/remove"}]', json_encode($patch));
  }

  public function testReplace() {
    $patch = new JSONPatchArray([
      'replace' => false,
      'remain' => 'value2',
    ], [
      'remain' => 'value2',
      'replace' => true,
    ]);
    $patch = new class ($patch) extends AbstractJSONPatch {};
    self::assertEquals('[{"op":"replace","path":"\/replace","value":true}]', json_encode($patch));
  }

  public function testComplex() {
    $patch = new JSONPatchArray([
      'id' => 1,
      'name' => 'Test',
      'phone' => '757 555-12-34',
      'address' => [
        'id' => 10,
        'city' => 'Norfolk',
        'state' => 'VA',
        'country' => [
          'code' => 'US',
          'name' => 'United States',
        ],
      ],
    ], [
      'id' => 1,
      'first_name' => 'Test',
      'last_name' => 'Example',
      'phone' => '757 555-1234',
      'address' => [
        'id' => 11,
        'city' => 'Norfolk',
        'region' => 'East of England',
        'country' => [
          'code' => 'GB',
          'name' => 'Great Britain',
        ],
      ],
    ]);
    self::assertEquals(implode('', [
      '[',
      '{"op":"add","path":"\/first_name","value":"Test"},',
      '{"op":"add","path":"\/last_name","value":"Example"},',
      '{"op":"remove","path":"\/name"},',
      '{"op":"replace","path":"\/phone","value":"757 555-1234"},',
      '{"op":"add","path":"\/address\/region","value":"East of England"},',
      '{"op":"remove","path":"\/address\/state"},',
      '{"op":"replace","path":"\/address\/id","value":11},',
      '{"op":"replace","path":"\/address\/country\/code","value":"GB"},',
      '{"op":"replace","path":"\/address\/country\/name","value":"Great Britain"}',
      ']',
    ]), json_encode($patch));
  }
}
