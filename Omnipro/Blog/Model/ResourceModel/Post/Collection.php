<?php
namespace Omnipro\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(\Omnipro\Blog\Model\Post::class, \Omnipro\Blog\Model\ResourceModel\Post::class);
    }
}
