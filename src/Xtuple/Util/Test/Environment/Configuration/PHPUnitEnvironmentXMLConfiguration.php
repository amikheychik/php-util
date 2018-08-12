<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\File\File\Regular\RegularFile;
use Xtuple\Util\Test\Environment\Configuration\Collection\Map\AbstractMapConfiguration;
use Xtuple\Util\Test\Environment\Configuration\Collection\Map\ArrayMapConfiguration;
use Xtuple\Util\XML\Element\XMLElementRegularFile;

final class PHPUnitEnvironmentXMLConfiguration
  extends AbstractMapConfiguration {
  /**
   * @throws \Throwable
   *
   * @param array $configurations
   */
  public function __construct(array $configurations = []) {
    if (empty($GLOBALS['PHPUNIT_ENVIRONMENT_XML_CONFIGURATION'])) {
      throw new Exception('Undefined PHPUNIT_ENVIRONMENT_XML_CONFIGURATION');
    }
    $element = new XMLElementRegularFile(
      new RegularFile(new FileFromPathString(strtr('{root}/{config}', [
        '{root}' => dirname($GLOBALS['__PHPUNIT_CONFIGURATION_FILE']),
        '{config}' => $GLOBALS['PHPUNIT_ENVIRONMENT_XML_CONFIGURATION'],
      ])))
    );
    $environment = [];
    foreach ($element->children('/environment/*') as $child) {
      if (isset($configurations[$child->name()])) {
        $environment[$child->name()] = new $configurations[$child->name()]($child);
      }
    }
    parent::__construct(new ArrayMapConfiguration($environment));
  }
}
