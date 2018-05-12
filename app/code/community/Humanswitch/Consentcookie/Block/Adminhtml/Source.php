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
 * Class Humanswitch_Consentcookie_Block_Source
 */
class Humanswitch_Consentcookie_Block_Adminhtml_Source extends Mage_Core_Block_Template
{

    /**
     * @return $this|Mage_Core_Block_Abstract
     * @throws Varien_Exception
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $helper = $this->helper('humanswitch_consentcookie');

        if ($helper->isActive(Humanswitch_Consentcookie_Helper_Data::CONFIG_CONFIGURATOR)) {

            /** @var Mage_Page_Block_Html_Head $headBlock */
            $headBlock = $this->getLayout()->getBlock('head');

            if ($helper->getConfiguration('method', Humanswitch_Consentcookie_Helper_Data::CONFIG_CONFIGURATOR) === 'local') {
                $headBlock->addItem('skin_css', 'consentcookie/css/app.css');
                $headBlock->addItem('skin_js', 'consentcookie/js/manifest.js');
                $headBlock->addItem('skin_js', 'consentcookie/js/vendor.js');
                $headBlock->addItem('skin_js', 'consentcookie/js/app.js');
            }

            $headBlock->addItem('skin_css', 'consentcookie/css/override.css');
            $headBlock->addItem('skin_js', 'consentcookie/js/vue-magento-patch.js');
        }

        return $this;
    }
}