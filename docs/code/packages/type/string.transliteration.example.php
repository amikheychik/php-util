<?php
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Transliteration\ASCIITransliterationString;
use Xtuple\Util\Type\String\Transliteration\Slug\URLSlugString;

// Transforming text into ASCII characters text
$ascii = new ASCIITransliterationString('Königsberg in Ostpreußen, 1255');
(string) $ascii === 'Konigsberg in Ostpreussen, 1255';
$ascii->original() === 'Königsberg in Ostpreußen, 1255';

// Using text in URL
$slug = new URLSlugString('Königsberg_in_Ostpreußen, 1255');

// All non alphanum characters,
// except underscore ('_') are replaced with '-'.
// Text is turned to lowercase.
(string) $slug === 'konigsberg_in_ostpreussen--1255';

// This include slashes `/`,
// as they are used to separate parts (slugs) of the URL.
$slug = new URLSlugString('Ostpreußen/Königsberg/1255');
(string) $slug === 'ostpreussen-konigsberg-1255';
