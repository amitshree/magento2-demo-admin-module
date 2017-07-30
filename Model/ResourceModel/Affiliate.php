<?php
namespace Amit\Affiliate\Model\ResourceModel;
class Affiliate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('amit_affiliate_affiliate','affiliate_id');
    }
}
