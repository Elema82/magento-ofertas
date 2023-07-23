<?php
namespace Omnipro\Blog\Block\Adminhtml\Blog;

use Magento\Backend\Block\Widget\Grid\Container;

class Grid extends Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Omnipro_Blog';
        $this->_controller = 'adminhtml_blog';
        $this->_headerText = __('Blog Posts');
        parent::_construct();
    }
}
