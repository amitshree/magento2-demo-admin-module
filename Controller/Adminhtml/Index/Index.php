<?php
namespace Amit\Affiliate\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
    
    const ADMIN_RESOURCE = 'Index';

    /**
     * Affiliate Factory
     *
     * @var \Amit\Affiliate\Model\AffiliateFactory
     */
    protected $_affiliateFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;


    protected $resultPageFactory;
    public function __construct(
        \Amit\Affiliate\Model\AffiliateFactory $affiliateFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_affiliateFactory           = $affiliateFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
    }
    
    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Amit_Affiliate::affiiate_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Affiliates'));

        return $resultPage;
    }

    /**
     * Init Affiliate
     *
     * @return \Amit\Affiliate\Model\Affiliate
     */
    protected function _initAffiliate()
    {
        $affiliateId  = (int) $this->getRequest()->getParam('affiliate_id');
        /** @var \Amit\Affiliate\Model\Affiliate $affiliate */
        $affiliate    = $this->_affiliateFactory->create();
        if ($affiliateId) {
            $affiliate->load($affiliateId);
        }
        $this->_coreRegistry->register('affiliate_data', $affiliate);
        return $affiliate;
    }
}
