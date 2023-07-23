<?php
declare(strict_types=1);

namespace Omnipro\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    const tableName = "omnipro_blog_post";
    const tablePrimaryKey = "post_id";

    protected function _construct()
    {
        $this->_init(self::tableName, self::tablePrimaryKey);
    }
}
