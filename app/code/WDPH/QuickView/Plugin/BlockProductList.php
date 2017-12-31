<?php
namespace WDPH\QuickView\Plugin;

class BlockProductList
{    
    protected $urlInterface;    
	protected $quickviewHelper;
	
    public function __construct(\Magento\Framework\UrlInterface $urlInterface,								
								\WDPH\QuickView\Helper\Data $quickviewHelper)
	{
		$this->quickviewHelper = $quickviewHelper;
        $this->urlInterface = $urlInterface;        
    }

    public function aroundGetProductDetailsHtml(\Magento\Catalog\Block\Product\ListProduct $subject, \Closure $proceed, \Magento\Catalog\Model\Product $product)
    {
		$result = $proceed($product);
        if($this->quickviewHelper->getConfig('general/enabled'))
		{			            
			$buttonStyle =  'wdph_quickview_button';
            $productUrl = $this->urlInterface->getUrl('wdph_quickview/catalog_product/view', array('id' => $product->getId()));
            return $result . '<a class="wdph-quickview '.$buttonStyle.'" data-quickview-url=' . $productUrl . ' href="javascript:void(0);"><span>' . __("Quickview") . '</span></a>';
        }        
        return $result;
    }
}
?>