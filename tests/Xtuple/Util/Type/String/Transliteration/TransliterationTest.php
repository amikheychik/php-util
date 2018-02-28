<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration;

use PHPUnit\Framework\TestCase;

class TransliterationTest
  extends TestCase {
  public function testASCIITransliteration() {
    $input = new ASCIITransliterationString('Königsberg in Ostpreußen, 1255');
    self::assertEquals('Konigsberg in Ostpreussen, 1255', (string) $input);
    self::assertEquals('Königsberg in Ostpreußen, 1255', $input->original());
    $input = new ASCIITransliterationString('Кёнигсберг в Восточной Пруссии');
    self::assertEquals('Kenigsberg v Vostocnoj Prussii', (string) $input);
  }
}
