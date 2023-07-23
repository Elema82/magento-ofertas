<?php
namespace Omnipro\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Omnipro\Blog\Model\ResourceModel\Post as BlogResource;

class Post extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(BlogResource::class);
    }
}
