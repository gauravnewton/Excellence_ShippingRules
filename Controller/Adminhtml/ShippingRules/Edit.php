<?php
namespace Excellence\ShippingRules\Controller\Adminhtml\ShippingRules;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');

        $model = $this->_objectManager
            ->create('Excellence\ShippingRules\Model\ShippingRules');

        $registryObject = $this->_objectManager
            ->get('Magento\Framework\Registry');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager
                    ->addError(__('This shipping rule no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager
            ->get('Magento\Backend\Model\Session')
            ->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $registryObject->register('shippingrules_shippingrules', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
