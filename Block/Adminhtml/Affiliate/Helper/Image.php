<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 30/7/17
 * Time: 11:29 PM
 */

namespace Amit\Affiliate\Block\Adminhtml\Affiliate\Helper;

use Magento\Framework\Data\Form\Element\Image as ImageField;
use Magento\Framework\Data\Form\Element\Factory as ElementFactory;
use Magento\Framework\Data\Form\Element\CollectionFactory as ElementCollectionFactory;
use Magento\Framework\Escaper;
use Amit\Affiliate\Model\Affiliate\Image as AffiliateImage;
use Magento\Framework\UrlInterface;

/**
 * @method string getValue()
 */
class Image extends ImageField
{
    /**
     * image model
     *
     * @var \[Namespace]\[Module]\Model\[Entity]\Image
     */
    protected $imageModel;

    /**
     * @param [Entity]Image $imageModel
     * @param ElementFactory $factoryElement
     * @param ElementCollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        AffiliateImage $imageModel,
        ElementFactory $factoryElement,
        ElementCollectionFactory $factoryCollection,
        Escaper $escaper,
        UrlInterface $urlBuilder,
        $data = []
    )
    {
        $this->imageModel = $imageModel;
        parent::__construct($factoryElement, $factoryCollection, $escaper, $urlBuilder, $data);
    }
/**
 * Get image preview url
 *
 * @return string
 */
protected function _getUrl()
{
    $url = false;
    if ($this->getValue()) {
        $url = $this->imageModel->getBaseUrl().$this->getValue();
    }
    return $url;
}
}