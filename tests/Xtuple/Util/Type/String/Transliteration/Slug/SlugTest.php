<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration\Slug;

use PHPUnit\Framework\TestCase;

class SlugTest
  extends TestCase {
  public function testURLSlugString() {
    $input = new URLSlugString('Königsberg in Ostpreußen, 1255');
    self::assertEquals('konigsberg-in-ostpreussen--1255', (string) $input);
    self::assertEquals('Königsberg in Ostpreußen, 1255', $input->original());
    $input = new URLSlugString('Ostpreußen/Königsberg/1255');
    self::assertEquals('ostpreussen-konigsberg-1255', (string) $input);
    $input = new URLSlugString('Ostpreußen_Königsberg_1255');
    self::assertEquals('ostpreussen_konigsberg_1255', (string) $input);
  }
}
