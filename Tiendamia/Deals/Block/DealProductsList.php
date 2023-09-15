<?php


namespace Tiendamia\Deals\Block;

use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;
use Magento\Framework\App\ActionInterface;
use Tiendamia\Deals\Helper\Data;

class DealProductsList extends \Magento\Catalog\Block\Product\AbstractProduct
{

    /**
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;
    protected $helper;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;
    /**
     * @param Context $context
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Framework\Data\Form\FormKey $formKey,
        Data $helper,
        array $data = []
    ) {
        $this->urlHelper = $urlHelper;
        $this->productFactory = $productloader;
        $this->formKey = $formKey;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
    /**
     * Get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    /**
     * Load Products collection
     *
     * @return Product array
     */
    public function getLoadProducts($category = 0)
    {

        $products = $this->productFactory->create()->getCollection();


        if($this->helper->isActive()) {

            $products->addAttributeToSelect(["name", "price", "image"])
                ->addCategoriesFilter(['in' => [$category]])
                ->addAttributeToFilter("visibility", ['neq' => 1])
                ->setPageSize(6);

        }

        return $products;
    }
    /**
     * Load Product
     *
     * @return Product array
     */
    public function getLoadProduct($id)
    {
        return $this->productFactory->create()->load($id);
    }

    /**
     * Get post parameters
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return array
     */
    public function getAddToCartPostParams(\Magento\Catalog\Model\Product $product)
    {
        $url = $this->getAddToCartUrl($product, ['_escape' => false]);
        return [
            'action' => $url,
            'data' => [
                'product' => (int) $product->getEntityId(),
                ActionInterface::PARAM_NAME_URL_ENCODED =>
                    $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }
    /**
     * Get product price.
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        if($this->helper->isActive()) {
            $priceRender = $this->getPriceRender($product);
            $price = '';
            if ($priceRender) {
                $price = $priceRender->render(
                    FinalPrice::PRICE_CODE,
                    $product,
                    [
                        'include_container' => false,
                        'display_minimal_price' => true,
                        'zone' => Render::ZONE_ITEM_LIST,
                        'list_category_page' => true
                    ]
                );
            }
            return $price;
        }
    }
    /**
     * Get price render
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return Render
     */
    protected function getPriceRender($product)
    {
        return $this->getLayout()->createBlock(\Magento\Framework\Pricing\Render::class, "product.price.render.default" . $product->getSku())
            ->setData('is_product_list', true);
    }

}
