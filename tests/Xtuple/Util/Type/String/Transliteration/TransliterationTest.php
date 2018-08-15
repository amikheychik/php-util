<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration;

use PHPUnit\Framework\TestCase;

class TransliterationTest
  extends TestCase {
  public function testASCIITransliteration() {
    /** @noinspection SpellCheckingInspection */
    $input = new ASCIITransliterationString('Königsberg in Ostpreußen, 1255');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('Konigsberg in Ostpreussen, 1255', (string) $input);
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('Königsberg in Ostpreußen, 1255', $input->original());
    $input = new ASCIITransliterationString('Кёнигсберг в Восточной Пруссии');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('Kenigsberg v Vostocnoj Prussii', (string) $input);
  }
}
