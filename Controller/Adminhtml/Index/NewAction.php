<?php

namespace Amit\Affiliate\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class NewAction extends \Magento\Backend\App\Action
{
    protected $_affiliateFactory;

    protected $_coreRegistry;

    public function __construct(
        \Amit\Affiliate\Model\AffiliateFactory $affiliateFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    )
    {

        $this->_affiliateFactory = $affiliateFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {

        $affiliateId  = (int) $this->getRequest()->getParam('affiliate_id');
        /** @var \Amit\Affiliate\Model\Affiliate $affiliate */
        $affiliate    = $this->_affiliateFactory->create();
        if ($affiliateId) {
            $affiliate = $affiliate->load($affiliateId);
            $affliateTitle = $affiliate->getTitle();
            if (!$affiliate->getEntityId()) {
                $this->messageManager->addError(__('Affiliate data no longer exist.'));
                $this->_redirect('affiliate/index/index');
                return;
            }
        }

        $this->_coreRegistry->register('affiliate_data', $affiliate);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $affiliateId ? __('Edit Affiliate Data ').$affliateTitle : __('Add Affiliate Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Amit_Affiliate::add_affiliate');
    }
}
