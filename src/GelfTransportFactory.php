<?php

namespace Drupal\upchuk_gelf;

use Drupal\Core\Site\Settings;
use Gelf\Transport\UdpTransport;

/**
 * Factory class for the GELF transport.
 */
class GelfTransportFactory {

  /**
   * Instantiates the UDP transport for GELF logging.
   *
   * @return \Gelf\Transport\UdpTransport
   */
  public function getTransport(): UdpTransport {
    $gelf_config = Settings::get('gelf_config');
    if (!$gelf_config) {
      return new UdpTransport();
    }

    $host = $gelf_config['host'] ?? NULL;
    $port = $gelf_config['port'] ?? 12201;
    $chunk_size = $gelf_config['chunk_size'] ?? UdpTransport::CHUNK_SIZE_WAN;
    return new UdpTransport($host, $port, $chunk_size);
  }

}
