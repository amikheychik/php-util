<?php declare(strict_types=1);

namespace Xtuple\Util\File\Path;

interface Path {
  /**
   * @throws \Throwable
   *
   * @return string
   */
  public function absolute(): string;

  public function exists(): bool;

  public function isDir(): bool;

  public function isFile(): bool;
}
