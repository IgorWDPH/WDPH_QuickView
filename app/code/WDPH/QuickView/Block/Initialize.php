<?php
namespace WDPH\QuickView\Block;

class Initialize extends \Magento\Framework\View\Element\Template
{    
    protected $_helper;

    public function __construct(\WDPH\QuickView\Helper\Data $helper,
                                \Magento\Framework\View\Element\Template\Context $context,
                                array $data = [])
    {
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }    

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
	
	public function getConfig()
    {
        return [
            'baseUrl' => $this->getBaseUrl()            
        ];
    }
}
