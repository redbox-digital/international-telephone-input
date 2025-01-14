<?php
/**
 *
 * @category   MaxMage
 * @author     MaxMage Core Team <maxmagedev@gmail.com>
 * @date       3/14/2018
 * @copyright  Copyright © 2018 MaxMage. All rights reserved.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @file       Data.php
 */

namespace MaxMage\InternationalTelephoneInput\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH_INTERNATIONAL_TELEPHONE_INPUT_MODULE_ENABLED = 'internationaltelephoneinput/general/enabled';

    const XML_PATH_INTERNATIONAL_TELEPHONE_MULTISELECT_COUNTRIES_ALLOWED = 'internationaltelephoneinput/general/allow';

    const XML_PATH_PREFERED_COUNTRY = 'general/store_information/country_id';

    /**
     * @return bool
     */
    public function isModuleEnabled()
    {
        return !!$this->getConfig(self::XML_PATH_INTERNATIONAL_TELEPHONE_INPUT_MODULE_ENABLED);
    }

    /**
     * @return string
     */
    public function allowedCountries()
    {
        return $this->getConfig(self::XML_PATH_INTERNATIONAL_TELEPHONE_MULTISELECT_COUNTRIES_ALLOWED);
    }

    /**
     * @return string
     */
    public function preferedCountry()
    {
        return $this->getConfig(self::XML_PATH_PREFERED_COUNTRY);
    }

    /**
     * @param string $configPath
     * @return mixed
     */
    protected function getConfig($configPath)
    {
        return $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Prepare telephone field config according to the Magento default config
     *
     * @param $addressType
     * @param string $method
     * @return array
     */
    public function telephoneFieldConfig($addressType, $method = '')
    {
        return  [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => $addressType . $method,
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'MaxMage_InternationalTelephoneInput/form/element/telephone',
                'tooltip' => [
                    'description' => 'For delivery questions.',
                    'tooltipTpl' => 'ui/form/element/helper/tooltip'
                ],
            ],
            'dataScope' => $addressType . $method . '.telephone',
            'dataScopePrefix' => $addressType . $method,
            'label' => __('Phone Number'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 120,
            'validation' => [
                "required-entry"    => true,
                "max_text_length"   => 255,
                "min_text_length"   => 1
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'focused' => false,
        ];
    }
}
