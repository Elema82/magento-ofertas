<?php

namespace Tiendamia\Deals\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Module\ModuleListInterface;
use Tiendamia\Deals\Logger\Logger as ModuleLogger;
use Tiendamia\Deals\Model\Config;


class Data extends AbstractHelper
{
    /**
     * @var ModuleLogger
     */
    protected $moduleLogger;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ModuleListInterface
     */
    protected $moduleList;

    const ENABLED  = 1;
    const DISABLED = 0;


    public function __construct(
        Context $context,
        ModuleLogger $moduleLogger,
        Config $config,
        StoreManagerInterface $storeManager,
        ModuleListInterface $moduleList
    ) {
        $this->moduleLogger = $moduleLogger;
        $this->config = $config;
        $this->storeManager = $storeManager;
        $this->moduleList = $moduleList;

        parent::__construct($context);
    }


    public function getConfigHelper()
    {
        return $this->config;
    }

    public function getExtensionVersion()
    {
        $moduleCode = 'Tiendamia_Deals';
        $moduleInfo = $this->moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }

    public function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_WEB,
            true
        );
    }

    public function isActive()
    {
        return ($this->config->isEnabled() && $this->verifyDate($this->config->getDueDate()));
    }

    private function verifyDate($date, $strict = true)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        if ($strict) {
            $errors = \DateTime::getLastErrors();
            if (!empty($errors['warning_count'])) {
                return false;
            }
        }
        $startDate = strtotime(date('Y-m-d H:i:s', strtotime($date) ) );
        $currentDate = strtotime(date('Y-m-d H:i:s'));

        if($startDate > $currentDate)
            return true;

        return false;
    }

    public function isDisabled()
    {
        return $this->config->getRegistrationOption() == self::DISABLED;
    }

    public function showDisabledMessage()
    {
        return $this->config->showDisabledMessage();
    }

    public function getTitlePage()
    {
        return $this->config->getTitlePage();
    }
    public function getDueDate()
    {
        return $this->config->getDueDate();
    }

    public function getCatId($slide)
    {
        return $this->config->getCatId($slide);
    }

    /**
     * Logging Utility
     *
     * @param $message
     * @param bool|false $useSeparator
     */
    public function log($message, $useSeparator = false)
    {
        if ($this->isActive()
            && $this->config->isDebugEnabled()
        ) {
            if ($useSeparator) {
                $this->moduleLogger->customLog(str_repeat('=', 100));
            }

            $this->moduleLogger->customLog($message);
        }
    }
}
