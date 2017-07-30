<?php

namespace Amit\Affiliate\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{

    public function __construct(
        \Amit\Affiliate\Model\AffiliateFactory $affiliateFactory,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_affiliateFactory = $affiliateFactory;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('affiliate_id');
        if ($id) {
            $name = "";
            try {
                /** @var \Amit\Affiliate\Model\Affiliate $affiliate */
                $affiliate = $this->_affiliateFactory->create();
                $affiliate->load($id);

                $name = $affiliate->getName();
                $affiliate->delete();
                $this->messageManager->addSuccess(__('The Affiliate has been deleted.'));

                $resultRedirect->setPath('affiliate/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_affiliate_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('affiliate/*/edit', ['affiliate_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Affiliate record to delete was not found.'));

        $resultRedirect->setPath('affiliate/*/');
        return $resultRedirect;
    }
}
