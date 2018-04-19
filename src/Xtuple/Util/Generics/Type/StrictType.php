<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type;

use Xtuple\Util\Exception\Exception;

final class StrictType
  implements Type {
  /** @var string */
  private $fqn;

  public function __construct(string $fqn) {
    $this->fqn = strtr('\\{type}', [
      '{type}' => ltrim($fqn, '\\'),
    ]);
  }

  public function fqn(): string {
    return $this->fqn;
  }

  public function cast($instance) {
    if (!is_object($instance)) {
      throw new Exception('{type} is passed, {required} is required', [
        'type' => gettype($instance),
        'required' => $this->fqn,
      ]);
    }
    if (!($instance instanceof $this->fqn)) {
      throw new Exception('\{class} is passed, {required} is required', [
        'class' => get_class($instance),
        'required' => $this->fqn,
      ]);
    }
    return $instance;
  }
}
