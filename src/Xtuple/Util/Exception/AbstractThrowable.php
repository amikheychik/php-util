<?php declare(strict_types=1);

namespace Xtuple\Util\Exception;

use Xtuple\Util\Exception\Collection\Sequence\ArrayListThrowable;
use Xtuple\Util\Exception\Collection\Sequence\ListThrowable;
use Xtuple\Util\Type\String\Message\Message\Collection\Sequence\ListMessage;
use Xtuple\Util\Type\String\Message\Message\Message;

abstract class AbstractThrowable
  extends \Exception
  implements Throwable {
  /** @var Message */
  private $translatable;
  /** @var ListMessage */
  private $errors;

  public function __construct(Message $message, ?\Throwable $previous = null, ?ListMessage $errors = null,
                              int $code = 0) {
    parent::__construct($message->__toString(), $code, $previous);
    $this->translatable = $message;
    $this->errors = $errors;
  }

  /** @var string */
  private $string;

  public final function __toString(): string {
    if ($this->string === null) {
      $output = [];
      foreach ($this->previous() as $i => $exception) {
        $output[] = strtr('{tab}{type}:{code} {message} in {file}:{line}', [
          '{tab}' => $i ? strtr('{pad}+ ', [
            '{pad}' => str_repeat("\t", $i),
          ]) : '',
          '{type}' => ($exception !== null) ? get_class($exception) : '',
          '{code}' => $exception->getCode() ?: '',
          '{message}' => $exception->getMessage(),
          '{file}' => $exception->getFile(),
          '{line}' => $exception->getLine(),
        ]);
        if ($exception instanceof Throwable
          && ($errors = $exception->errors())
          && $errors !== null) {
          foreach ($errors as $error) {
            $output[] = strtr('{tab}- {message}', [
              '{tab}' => str_repeat("\t", $i + 1),
              '{message}' => (string) $error,
            ]);
          }
        }
      }
      $this->string = implode("\n", $output);
    }
    return $this->string;
  }

  /** @noinspection ClassMethodNameMatchesFieldNameInspection */
  public final function message(): Message {
    return $this->translatable;
  }

  public final function previous(): ListThrowable {
    /** @var \Throwable[] $exceptions */
    $exceptions = [];
    $exception = $this;
    do {
      $exceptions[] = $exception;
    }
    while ($exception = $exception->getPrevious());
    /** @noinspection PhpUnhandledExceptionInspection - $exceptions types verified */
    return new ArrayListThrowable($exceptions);
  }

  public final function errors(): ?ListMessage {
    return $this->errors;
  }
}
