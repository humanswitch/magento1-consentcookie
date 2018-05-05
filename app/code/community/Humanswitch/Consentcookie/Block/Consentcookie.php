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
 * Class Humanswitch_Consentcookie_Block_Consentcookie
 */
class Humanswitch_Consentcookie_Block_Consentcookie extends Mage_Core_Block_Template
{

    /**
     * Checks whether consentcookie was activated in the system configuration.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper('humanswitch_consentcookie')->isActive();
    }

    /**
     * Gets the JSON configuration.
     *
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->helper('humanswitch_consentcookie')->getConfiguration();
    }

    /**
     * Validates the format of the configuration in JSON.
     *
     * @param null $configuration
     * @return bool
     */
    public function validateJson($configuration = null)
    {
        return $this->helper('humanswitch_consentcookie')->validateJSONConfiguration($configuration);
    }

}