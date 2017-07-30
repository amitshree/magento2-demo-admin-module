<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 30/7/17
 * Time: 3:09 PM
 */

namespace Amit\Affiliate\Block\Adminhtml\Affiliate;


class AddAffiliate extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }


    protected function _construct()
    {
        $this->_objectId = 'affiliate_id';
        $this->_blockGroup = 'Amit_Affiliate';
        $this->_controller = 'adminhtml_affiliate';
        parent::_construct();
       // if ($this->_isAllowedAction('Amit_Affiliate::add_affiliate')) {
            $this->buttonList->update('save', 'label', __('Save'));
       /* } else {
            $this->buttonList->remove('save');
        }*/
        $this->buttonList->remove('reset');
    }

    /**
     * Retrieve text for header element depending on loaded image.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Add Affiliate Data');
    }

    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }

        return $this->getUrl('*/*/save');
    }
}