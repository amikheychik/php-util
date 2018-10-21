<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedString;
use Xtuple\Util\Type\String\Encoding\Base64\Decode\Base64DecodedStringFromEncoded;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedString;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\Base64EncodedStringFromDecoded;

// Encoded string is built from decoded stringa and vice versa.
$encoded = new Base64EncodedStringFromDecoded(
  new Base64DecodedString('decoded')
);
$decoded = new Base64DecodedStringFromEncoded($encoded);
// Following is true:
(string) $encoded === 'ZGVjb2RlZA==';
(string) $decoded === 'decoded';

// Encoding and decoding are lazy by default (performed by __toString())
$failed = new Base64DecodedStringFromEncoded(
  new Base64EncodedString('ŻGVjb2RlZÄ==')
);
// Throws an exception, as input contains characters outside of the base64 alphabet
$failed->__toString();
