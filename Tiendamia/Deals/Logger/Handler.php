<?php

namespace Tiendamia\Deals\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/tiendamia_deals.log';

    /**
     * @var int
     */
    protected $loggerType = \Monolog\Logger::INFO;
}
