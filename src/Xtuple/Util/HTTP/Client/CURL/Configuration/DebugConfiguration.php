<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Configuration;

final class DebugConfiguration
  extends AbstractConfiguration {
  public function __construct(?Configuration $configuration = null) {
    $configuration = $configuration ?: new DefaultConfiguration();
    parent::__construct(new ConfigurationStruct(
      true,
      $configuration->timeout()
    ));
  }
}
