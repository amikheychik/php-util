<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Configuration;

final class DefaultConfiguration
  extends AbstractConfiguration {
  public function __construct() {
    parent::__construct(new ConfigurationStruct(
      false,
      ini_get('max_execution_time') * 0.5
    ));
  }
}
