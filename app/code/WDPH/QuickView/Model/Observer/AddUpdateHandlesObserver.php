<?php
namespace WDPH\QuickView\Model\Observer;

class AddUpdateHandlesObserver implements \Magento\Framework\Event\ObserverInterface
{    
	protected $quickviewHelper;
    
    public function __construct(\WDPH\QuickView\Helper\Data $quickviewHelper)
    {
		$this->quickviewHelper = $quickviewHelper;        
    }    
   
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
		if($this->quickviewHelper->getConfig('general/enabled'))
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
}
?>
