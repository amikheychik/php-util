<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\PDO\Connection;

use Xtuple\Util\XML\Element\XMLElement;

final class ConnectionXMLElement
  extends AbstractConnection {
  public function __construct(XMLElement $element) {
    parent::__construct(new ConnectionStruct(
      ($attribute = $element->attributes()->get('host')) ? $attribute->value() : '',
      ($attribute = $element->attributes()->get('port')) ? (int) $attribute->value() : 0,
      ($attribute = $element->attributes()->get('database')) ? $attribute->value() : '',
      ($attribute = $element->attributes()->get('username')) ? $attribute->value() : '',
      ($attribute = $element->attributes()->get('password')) ? $attribute->value() : ''
    ));
  }
}
