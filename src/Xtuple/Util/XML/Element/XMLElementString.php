<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

final class XMLElementString
  extends AbstractXMLElement {
  public function __construct(string $xml) {
    parent::__construct(new XMLElementSimple(
      new \SimpleXMLElement($xml)
    ));
  }
}
