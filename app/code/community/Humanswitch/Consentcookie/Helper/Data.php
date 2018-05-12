<?php
/**
 *    Copyright 2018 Humanswitch
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */

/**
 * Class Humanswitch_Consentcookie_Helper_Data
 */
class Humanswitch_Consentcookie_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * ConsentCookie general settings path
     */
    CONST CONFIG_GENERAL = 'consentcookie/general';

    /**
     * ConsentCookie configurator settings path
     */
    CONST CONFIG_CONFIGURATOR = 'consentcookie/configurator_settings';

    /**
     * @var array The required configurator CDN assets
     */
    CONST CONFIGURATOR_CDN_ASSETS = [
        [
            'type' => 'style',
            'url' => 'https://www.consentcookie.nl/configurator/static/css/app.css'
        ],
        [
            'type' => 'script',
            'url' => 'https://www.consentcookie.nl/configurator/static/js/manifest.js'
        ],
        [
            'type' => 'script',
            'url' => 'https://www.consentcookie.nl/configurator/static/js/vendor.js'
        ],
        [
            'type' => 'script',
            'url' => 'https://www.consentcookie.nl/configurator/static/js/app.js'
        ]
    ];

    /**
     * Gets a plugin configurations
     *
     * @param $field
     * @param string $area
     * @param null $storeId
     * @return mixed
     * @throws Mage_Core_Model_Store_Exception
     */
    public function getConfiguration($field, $area = self::CONFIG_GENERAL, $storeId = null)
    {
        return Mage::getStoreConfig($area . ($field ? '/' . $field : ''), Mage::app()->getStore($storeId));
    }

    /**
     * Get active state from system configuration
     *
     * @param string $area
     * @param null $storeId
     * @return mixed
     */
    public function isActive($area = self::CONFIG_GENERAL, $storeId = null)
    {
        return $this->getConfiguration('active', $area, $storeId);
    }

    /**
     * Get CC configuration from system configuration
     *
     * @param bool $validateJson
     * @param null $storeId
     * @return mixed
     */
    public function getConsentCookieConfiguration($validateJson = true, $storeId = null)
    {
        $configuration = $this->getConfiguration('configuration', self::CONFIG_CONFIGURATOR, $storeId);

        if ($validateJson && !$this->validateConsentCookieConfiguration($configuration)) {
            return false;
        }

        return $configuration;
    }

    /**
     * Validates the JSON format.
     *
     * @param null $configuration
     * @return bool|mixed|null
     */
    public function validateConsentCookieConfiguration($configuration = null)
    {
        if ($configuration === null) {
            $configuration = $this->getConsentCookieConfiguration(false);
        }

        json_decode($configuration);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $configuration;
        }

        Mage::log('The ConsentCookie configuration in JSON format is invalid.');
        return false;
    }

    /**
     * Loads ConsentCookie by CDN.
     *
     * @return string
     */
    public function loadCCByCDN()
    {
        if ($this->getConfiguration('method') === 'cdn') {
            return sprintf('<script type="text/javascript" src="%s"></script>', $this->getConfiguration('cdn_url'));
        }
        return null;
    }

    /**
     * Loads configurator assets by CDN.
     *
     * @return string
     */
    public function loadConfiguratorByCDN()
    {
        if ($this->isActive(self::CONFIG_CONFIGURATOR) && $this->getConfiguration('method', self::CONFIG_CONFIGURATOR) === 'cdn') {
            $text = '';
            foreach (self::CONFIGURATOR_CDN_ASSETS as $asset) {
                if ($asset['type'] === 'style') {
                    $text .= sprintf('<link href="%s" rel="stylesheet">' . PHP_EOL, $asset['url']);
                } else {
                    $text .= sprintf('<script src="%s" type="text/javascript"></script>' . PHP_EOL, $asset['url']);
                }
            }
            return $text;
        }
        return null;
    }

}