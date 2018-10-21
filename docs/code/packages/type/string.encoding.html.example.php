<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedString;
use Xtuple\Util\Type\String\Encoding\HTML\Decode\HTMLDecodedStringFromEncoded;
use Xtuple\Util\Type\String\Encoding\HTML\Encode\HTMLEncodedStringFromDecoded;

// By default, default_charset is used.
ini_set('default_charset', 'iso-8859-1');

// To get an encoded string, a decoded source string should be provided.
$original = new HTMLDecodedString('<a href="/">Home\'s page</a>');
$encoded = new HTMLEncodedStringFromDecoded($original);
// Following is true:
(string) $encoded === '&lt;a href=&quot;/&quot;&gt;Home\'s page&lt;/a&gt;';
$encoded->charset() === 'iso-8859-1';

$encoded = new HTMLEncodedStringFromDecoded(
// Custom charset and quotes handling can be provided
  new HTMLDecodedString('<a href="/">Home\'s page</a>', ENT_QUOTES, 'UTF-8')
);
// Note: single quote is replaced with &#039;
(string) $encoded === '&lt;a href=&quot;/&quot;&gt;Home&#039;s page&lt;/a&gt;';

// Decoding a string
$decoded = new HTMLDecodedStringFromEncoded($encoded);
(string) $decoded === '<a href="/">Home\'s page</a>';
