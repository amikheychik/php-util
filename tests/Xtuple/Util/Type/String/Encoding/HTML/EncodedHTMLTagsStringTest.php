<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Encoding\HTML\Encode\EncodedHTMLTagsString;

final class EncodedHTMLTagsStringTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testLifeCycle() {
    self::assertEquals(
      '&lt;b&gt;this&lt;/b&gt; &amp;is &lt;br/&gt; &lt;i&gt;a test&lt;/i&gt; &lt;h2&gt;string&lt;/h2&gt; "Double Quotes" and &cent;',
      (string) new EncodedHTMLTagsString('<b>this</b> &is <br/> <i>a test</i> <h2>string</h2> "Double Quotes" and ¢')
    );
  }
}
