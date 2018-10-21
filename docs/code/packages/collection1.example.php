<?php
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Sequence\Sequence;

/**
 * List<stdClass> <1>
 */
interface ListStdClass
  extends Sequence { // <2>
  /**
   * @return \stdClass|null <3>
   *
   * @param int $key
   */
  public function get(int $key);

  /**
   * @return \stdClass|null <4>
   */
  public function current();

  public function name(): string; // <5>
}
