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
 * Class Humanswitch_Consentcookie_Block_Adminhtml_System_Config_Configurator
 */
class Humanswitch_Consentcookie_Block_Adminhtml_System_Config_Configurator extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
     * @var string
     */
    protected $_template = 'humanswitch/consentcookie/configurator.phtml';

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->toHtml();
    }

    /**
     * Checks whether consentcookie was activated in the system configuration.
     *
     * @return bool
     * @throws Varien_Exception
     */
    public function isEnabled()
    {
        return $this->helper('humanswitch_consentcookie')->isActive(Humanswitch_Consentcookie_Helper_Data::CONFIG_CONFIGURATOR);
    }

    /**
     * @return mixed
     * @throws Varien_Exception
     */
    public function getConsentCookieConfiguration()
    {
        return $this->helper('humanswitch_consentcookie')->getConsentCookieConfiguration();
    }
}
