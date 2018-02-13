<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe;

use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedString;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedStringFromDecoded;

final class URLSafeBase64EncodedStringFromString
  extends AbstractURLSafeBase64EncodedString {
  public function __construct(string $string) {
    parent::__construct(new URLSafeBase64EncodedString(
      new Base64EncodedStringFromDecoded(
        new Base64DecodedString($string)
      )
    ));
  }
}
