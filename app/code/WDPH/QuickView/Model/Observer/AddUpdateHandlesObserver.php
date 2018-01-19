<?php
namespace WDPH\QuickView\Model\Observer;

class AddUpdateHandlesObserver implements \Magento\Framework\Event\ObserverInterface
{   
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
