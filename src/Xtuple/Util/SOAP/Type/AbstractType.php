<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type;

abstract class AbstractType
  implements Type {
  /** @var Type */
  private $type;

  public function __construct(Type $type) {
    $this->type = $type;
  }

  public final function encoding(): int {
    return $this->type->encoding();
  }

  public final function name(): string {
    return $this->type->name();
  }

  public final function namespace(): string {
    return $this->type->namespace();
  }
}
