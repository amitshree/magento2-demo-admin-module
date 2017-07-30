<?php

namespace Amit\Affiliate\Controller\Adminhtml\Index;

class Edit extends \Amit\Affiliate\Controller\Adminhtml\Index\Index {
    /**
     * Backend session
     * 
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * Page factory
     * 
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result JSON factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * constructor
     * 
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Amit\Affiliate\Model\AffiliateFactory $affiliateFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Model\Session $backendSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Amit\Affiliate\Model\AffiliateFactory $affiliateFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession    = $backendSession;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($affiliateFactory, $registry, $context, $resultPageFactory);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('affiliate_id');

        $affiliate = $this->_initAffiliate();
        /** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Amit_Affiliate::affiiate_menu');
        $resultPage->getConfig()->getTitle()->set(__('Affiliates'));
        if ($id) {
            $affiliate->load($id);
            if (!$affiliate->getId()) {
                $this->messageManager->addError(__('This Affiliate no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'affiliate/*/edit',
                    [
                        'affiliate_id' => $affiliate->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $affiliate->getId() ? $affiliate->getName() : __('New Affiliate');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_backendSession->getData('affiliate_data', true);
        if (!empty($data)) {
            $affiliate->setData($data);
        }
        return $resultPage;
    }

    /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Amit_Affiliate::edit');
    }
}
