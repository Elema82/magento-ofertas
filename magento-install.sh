#!/bin/bash

mkdir magento
cd magento
curl -s https://raw.githubusercontent.com/markshust/docker-magento/master/lib/template | bash
bin/download 2.4.6-p2 community
bin/setup magento.test
bin/magento deploy:mode:set developer
bin/composer require markshust/magento2-module-disabletwofactorauth
bin/magento module:enable MarkShust_DisableTwoFactorAuth
bin/magento sampledata:deploy
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento config:set twofactorauth/general/enable 0
bin/magento cache:flush
