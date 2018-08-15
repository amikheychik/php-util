<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration\Slug;

use PHPUnit\Framework\TestCase;

class SlugTest
  extends TestCase {
  public function testURLSlugString() {
    /** @noinspection SpellCheckingInspection */
    $input = new URLSlugString('Königsberg in Ostpreußen, 1255');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('konigsberg-in-ostpreussen--1255', (string) $input);
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('Königsberg in Ostpreußen, 1255', $input->original());
    /** @noinspection SpellCheckingInspection */
    $input = new URLSlugString('Ostpreußen/Königsberg/1255');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('ostpreussen-konigsberg-1255', (string) $input);
    /** @noinspection SpellCheckingInspection */
    $input = new URLSlugString('Ostpreußen_Königsberg_1255');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('ostpreussen_konigsberg_1255', (string) $input);
  }
}
