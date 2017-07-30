<?php
namespace Amit\Affiliate\Api;

use Amit\Affiliate\Api\Data\AffiliateInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface AffiliateRepositoryInterface 
{
    public function save(AffiliateInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(AffiliateInterface $page);

    public function deleteById($id);
}
