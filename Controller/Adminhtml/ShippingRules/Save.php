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
            $model = $this->_objectManager->create('Excellence\ShippingRules\Model\ShippingRules');

            /* if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
            $uploader = $this->_objectManager->create('Magento\Core\Model\File\Uploader', array('fileId' => 'image'));
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
            ->getDirectoryRead(DirectoryList::MEDIA);
            $config = $this->_objectManager->get('Magento\Bannerslider\Model\Banner');
            $result = $uploader->save($mediaDirectory->getAbsolutePath('bannerslider/images'));
            unset($result['tmp_name']);
            unset($result['path']);
            $data['image'] = $result['file'];
            } catch (Exception $e) {
            $data['image'] = $_FILES['image']['name'];
            }
            }
            else{
            $data['image'] = $data['image']['value'];
            } */

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
                $this->messageManager->addSuccess(__('Shipping Rule Saved Successfully.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getPostValue('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the rule.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getPostValue('id')));
            return;
        }
        $this->_redirect('*/*/');
    }
}