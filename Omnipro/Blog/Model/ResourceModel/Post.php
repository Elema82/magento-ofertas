<?php
namespace Omnipro\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('omnipro_blog_post', 'post_id');
    }
}
