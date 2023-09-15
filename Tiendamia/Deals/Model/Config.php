<?php

namespace Tiendamia\Deals\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    const XML_PATH_ENABLED = 'tiendamia_deals/general/enabled';
    const DISABLED = 0;
    const XML_PATH_DEBUG = 'tiendamia_deals/general/debug';

//    const XML_PATH_REGISTRATION_OPTION = 'tiendamia_deals/registration/registration_option';
    const XML_PATH_TITLE_PAGE = 'tiendamia_deals/general/title_page';
    const XML_PATH_DISABLED_MESSAGE = 'tiendamia_deals/general/disabled_message';
    const XML_PATH_DUE_DATE = 'tiendamia_deals/general/due_date';
    const XML_PATH_CAT_ID_ARG = 'tiendamia_deals/general/category_arg';
    const XML_PATH_CAT_ID_URU = 'tiendamia_deals/general/category_uru';
    const XML_PATH_CAT_ID_CHI = 'tiendamia_deals/general/category_chi';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getConfigFlag($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled($storeId = null)
    {

        return (intval($this->getConfigValue(self::XML_PATH_ENABLED)) != self::DISABLED);
    }

    public function isDebugEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_DEBUG, $storeId);
    }

    public function showDisabledMessage($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_DISABLED_MESSAGE, $storeId);
    }

    public function getTitlePage()
    {
        return $this->getConfigValue(self::XML_PATH_TITLE_PAGE);
    }

    public function getDueDate()
    {
        return $this->getConfigValue(self::XML_PATH_DUE_DATE);
    }

    public function getCatId($slide)
    {
        switch ($slide) {
            case 1:
                return $this->getConfigValue(self::XML_PATH_CAT_ID_ARG);
                break;
            case 2:
                return $this->getConfigValue(self::XML_PATH_CAT_ID_URU);
                break;
            case 3:
                return $this->getConfigValue(self::XML_PATH_CAT_ID_CHI);
                break;
            default:
                return $this->getConfigValue(self::XML_PATH_CAT_ID_ARG);
        }
    }
}
