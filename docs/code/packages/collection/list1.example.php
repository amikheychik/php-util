<?php declare(strict_types=1);

use Xtuple\Util\Collection\Sequence\ArrayList\ArrayList;

// Lists remove all the array keys, and start numeration from 0.
$list = new ArrayList(['one' => 1, 'two' => 2, 'three' => 3]);

// Returns 2, as 'two' is removed.
$list->get(1);
