<?php
namespace WDPH\QuickView\Model\Observer;

class AddUpdateHandlesObserver implements \Magento\Framework\Event\ObserverInterface
{     
    const XML_PATH_QUICKVIEW_REMOVE_PRODUCT_IMAGE = 'weltpixel_quickview/general/remove_product_image';
    const XML_PATH_QUICKVIEW_REMOVE_PRODUCT_IMAGE_THUMB = 'weltpixel_quickview/general/remove_product_image_thumb';
    const XML_PATH_QUICKVIEW_REMOVE_AVAILABILITY = 'weltpixel_quickview/general/remove_availability';
    protected $scopeConfig;
    protected $request;
    protected $_storeManager;
    protected $productRepository;
	protected $quickviewHelper;
    
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\App\Request\Http $request,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
								\WDPH\QuickView\Helper\Data $quickviewHelper)
    {
		$this->quickviewHelper = $quickviewHelper;
        $this->scopeConfig = $scopeConfig;
        $this->request = $request;
        $this->_storeManager = $storeManager;
        $this->productRepository = $productRepository;
    }    
   
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $layout = $observer->getData('layout');
        if($observer->getData('full_action_name') != 'wdph_quickview_catalog_product_view') 
		{
            return $this;
        }
        /*$productId= $this->request->getParam('id');
        if(isset($productId))
		{
            try
			{
                $product = $this->productRepository->getById($productId, false, $this->_storeManager->getStore()->getId());
            }
			catch(\Magento\Framework\Exception\NoSuchEntityException $e)
			{
                return false;
            }
            $productType = $product->getTypeId();
            $layout->getUpdate()->addHandle('weltpixel_quickview_catalog_product_view_type_' . $productType);
        }*/             
        if($this->quickviewHelper->getConfig('general/hide_product_info_details'))
		{
            $layout->getUpdate()->addHandle('wdph_quickview_removeproductinfo_details');
        }
		if($this->quickviewHelper->getConfig('general/hide_related'))
		{				
            $layout->getUpdate()->addHandle('wdph_quickview_hide_related');
        }
		if($this->quickviewHelper->getConfig('general/hide_upsell'))
		{				
            $layout->getUpdate()->addHandle('wdph_quickview_hide_upsell');
        }
		if($this->quickviewHelper->getConfig('general/hide_social'))
		{				
            $layout->getUpdate()->addHandle('wdph_quickview_hide_social');
        }
        return $this;
    }
}
