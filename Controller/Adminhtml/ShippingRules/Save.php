<?php
namespace Excellence\ShippingRules\Controller\Adminhtml\ShippingRules;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $model = $this->_objectManager
                ->create('Excellence\ShippingRules\Model\ShippingRules');
            $data['shipping_method'] = implode(",", $data['shipping_method']);
            $data['customer_group'] = implode(",", $data['customer_group']);
            $data['store_view'] = implode(",", $data['store_view']);

            $id = $this->getRequest()->getPostValue('id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager
                    ->addSuccess(__('Shipping Rule Saved Successfully.'));
                $this->_objectManager
                    ->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getPostValue('back')) {
                    $this->_redirect('*/*/edit', array(
                        'id' => $model->getId(), '_current' => true)
                    );
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                    ->addException($e, __('Something went wrong while saving the rule.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array(
                'id' => $this->getRequest()->getPostValue('id'),
            ));
            return;
        }
        $this->_redirect('*/*/');
    }
}
