<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 30/7/17
 * Time: 6:14 PM
 */

namespace Amit\Affiliate\Block\Adminhtml\Affiliate;



class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;

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

        if ($this->_isAllowedAction('Amit_Affiliate::edit')) {
            $this->buttonList->update('save', 'label', __('Save Affiliate'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Amit_Affiliate::deleter')) {
            $this->buttonList->update('delete', 'label', __('Delete Affiliate'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    public function getModel()
    {
        return $this->_coreRegistry->registry('affiliate_data');
    }

    public function getHeaderText()
    {
        if ($this->getModel()->getId()) {
            return __("Edit Affiliate '%1'", $this->escapeHtml($this->getModel()->getTitle()));
        } else {
            return __('New Affiliate');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('affiliate/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}