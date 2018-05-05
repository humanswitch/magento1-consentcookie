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
     * ConsentCookie system config setting base path
     */
    CONST CONFIG_CC = 'consentcookie/settings';

    /**
     * Get settings from system configuration
     *
     * @param bool $field
     * @param null $id
     * @return mixed
     * @throws Mage_Core_Model_Store_Exception
     */
    public function getSettings($field = false, $id = null)
    {
        return Mage::getStoreConfig(self::CONFIG_CC . ($field ? '/' . $field : ''), Mage::app()->getStore($id));
    }

    /**
     * Get active state from system configuration
     *
     * @return mixed
     */
    public function isActive()
    {
        return $this->getSettings('active');
    }

    /**
     * Get CC configuration from system configuration
     *
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->getSettings('configuration');
    }

    /**
     * Validates whether the configuration is proper JSON.
     *
     * @todo validate against JSON schema
     *
     * @param null $configuration
     * @return bool
     */
    public function validateJSONConfiguration($configuration = null)
    {
        if ($configuration === null) {
            $configuration = $this->getConfiguration();
        }

        if ($configuration) {
            json_decode($this->getConfiguration());
            if (json_last_error() === JSON_ERROR_NONE) {
                return true;
            }
            Mage::log('The ConsentCookie JSON configuration is invalid.');
        }
        return false;
    }

}