<?php
namespace WDPH\QuickView\Controller\Catalog;

class Updatecart extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        if(!$this->getRequest()->isAjax())
		{
            $this->_redirect('/');
            return;
        }        
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode(array('result' => true)));
    }
}
?>