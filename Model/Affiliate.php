<?php
namespace Amit\Affiliate\Model;
class Affiliate extends \Magento\Framework\Model\AbstractModel implements \Amit\Affiliate\Api\Data\AffiliateInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'amit_affiliate_affiliate';

    protected function _construct()
    {
        $this->_init('Amit\Affiliate\Model\ResourceModel\Affiliate');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
