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
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Amit\Affiliate\Model\Affiliate\Image $imageModel,
        \Amit\Affiliate\Model\Affiliate $affiliate,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->imageModel = $imageModel;
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
            $profileImage = $this->uploadFileAndGetName('profile_image', $this->imageModel->getBaseDir(), $data);
            $affiliateData->setProfileImage($profileImage);
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

    public function uploadFileAndGetName($input, $destinationFolder, $data)
    {
        try {
            if (isset($data[$input]['delete'])) {
                return '';
            } else {
                $uploader = $this->uploaderFactory->create(['fileId' => $input]);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                $result = $uploader->save($destinationFolder);
                return $result['file'];
            }
        } catch (\Exception $e) {
            if ($e->getCode() != \Magento\Framework\File\Uploader::TMP_NAME_EMPTY) {
                throw new FrameworkException($e->getMessage());
            } else {
                if (isset($data[$input]['value'])) {
                    return $data[$input]['value'];
                }
            }
        }
        return '';
    }
}