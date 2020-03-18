<?php

namespace Drupal\acquia_pendo\Config;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Override the Pendo API key configuration if the AH_PENDO_KEY environment
 * variable is set. Acquia Cloud Hosting automatically sets the AH_PENDO_KEY
 * environment variable.
 */
class AcquiaPendoAhKeyOverrider implements ConfigFactoryOverrideInterface {

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names) {
    $overrides = [];
    if (in_array('pendo.settings', $names)) {
      if ($ahPendoApiKey = getenv('AH_PENDO_KEY')) {
        $overrides['pendo.settings'] = ['api_key' => $ahPendoApiKey];
      }
    }
    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'AcquiaPendoAhKeyOverrider';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }
}
