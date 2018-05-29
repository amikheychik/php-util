<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Element;

use Xtuple\Util\SOAP\Type\Type;
use Xtuple\Util\SOAP\Variable\SOAPVariable;
use Xtuple\Util\SOAP\Variable\SOAPVariableStruct;

final class ElementStruct
  implements Element {
  /** @var Type */
  private $type;
  /** @var string */
  private $name;
  /** @var null|string */
  private $namespace;
  /** @var mixed */
  private $data;

  /**
   * @param Type        $type
   * @param string      $name
   * @param null|string $namespace
   * @param mixed       $data
   */
  public function __construct(Type $type, string $name, ?string $namespace, $data) {
    $this->type = $type;
    $this->name = $name;
    $this->namespace = $namespace;
    $this->data = $data;
  }

  public function type(): Type {
    return $this->type;
  }

  public function name(): string {
    return $this->name;
  }

  public function namespace(): ?string {
    return $this->namespace;
  }

  public function soap(): SOAPVariable {
    return new SOAPVariableStruct(
      new \SoapVar(
        $this->data,
        $this->type->encoding(),
        $this->type->name(),
        $this->type->namespace(),
        $this->name,
        (string) $this->namespace
      )
    );
  }
}
