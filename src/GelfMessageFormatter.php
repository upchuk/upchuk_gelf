<?php

namespace Drupal\upchuk_gelf;

use Drupal\Core\Site\Settings;
use Monolog\Formatter\GelfMessageFormatter as OriginalGelfMessageFormatter;

/**
 * Override of the GELF formatter.
 */
class GelfMessageFormatter extends OriginalGelfMessageFormatter {

  /**
   * {@inheritdoc}
   */
  public function __construct(?string $systemName = null, ?string $extraPrefix = null, string $contextPrefix = 'ctxt_', ?int $maxLength = null) {
    parent::__construct($systemName, $extraPrefix, $contextPrefix, $maxLength);
    $gelf_config = Settings::get('gelf_config');
    if (!$gelf_config || !isset($gelf_config['source']) || $systemName) {
      return;
    }

    $this->systemName = $gelf_config['source'];
  }

}
