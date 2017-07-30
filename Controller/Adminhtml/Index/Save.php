<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 30/7/17
 * Time: 3:47 PM
 */

namespace Amit\Affiliate\Controller\Adminhtml\Index;


class Save extends \Magento\Backend\App\Action
{

    public function __construct(
        \Amit\Affiliate\Model\Affiliate $affiliate,
        \Magento\Backend\App\Action\Context $context
    )
    {
       $this->affiliate = $affiliate;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('affiliate/index/new');
            return;
        }
        try {
            $affiliateData = $this->affiliate;
            $affiliateData->setData($data);
            if (isset($data['id'])) {
                $affiliateData->setAffiliateId($data['id']);
            }
            $affiliateData->save();
            $this->messageManager->addSuccess(__('Affiliate data has been successfully saved.'));
        } catch (Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('affiliate/index/index');
    }

    /**
     * Check Category Map permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Amit_Affiliate::save');
    }
}