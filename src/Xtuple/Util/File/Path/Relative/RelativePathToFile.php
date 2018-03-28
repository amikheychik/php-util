<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path\Relative;

use Xtuple\Util\File\File\File;

final class RelativePathToFile
  implements RelativePath {
  /** @var string */
  private $from;
  /** @var File */
  private $to;

  public function __construct(string $from, File $to) {
    $this->from = $from;
    $this->to = $to;
  }

  public function relative(): string {
    $from = $this->from;
    $to = $this->to->path()->absolute();
    $stack = 0;
    while (strpos($to, $from) !== 0) {
      if (preg_match('/^(.*)\/(.*)$/', $from, $matches)) {
        $from = preg_replace('/^(.*)\/(.*)$/', '$1', $from);
        $stack++;
      }
    }
    return strtr('{up}{down}', [
      '{up}' => str_repeat('../', $stack),
      '{down}' => ltrim(str_replace($from, '', $to), '/'),
    ]);
  }

  public function absolute(): string {
    return $this->to->path()->absolute();
  }

  public function exists(): bool {
    return !is_null($this->absolute());
  }

  public function isDir(): bool {
    return $this->exists() ? is_dir($this->absolute()) : false;
  }

  public function isFile(): bool {
    return $this->exists() ? is_file($this->absolute()) : false;
  }
}
