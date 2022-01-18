<?php

namespace Drupal\upchuk_gelf;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\Core\Site\Settings;


/**
 * Remove the GELF handlers if we don't have it configured.
 */
class UpchukGelfServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $gelf_config = Settings::get('gelf_config');
    if ($gelf_config) {
      return;
    }

    $handlers = $container->getParameter('monolog.channel_handlers');
    foreach ($handlers as $type => &$definitions) {
      $definitions['handlers'] = array_filter($definitions['handlers'], function ($info) {
        return $info['name'] !== 'gelf';
      });
    }

    $container->setParameter('monolog.channel_handlers', $handlers);
  }
}
