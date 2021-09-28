<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Pike\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use AHT\Pike\Api\PikeRepositoryInterface as PikeRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Pike\Api\Data\PikeInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Cms::block';

    /**
     * @var \Magento\Cms\Api\PikeRepositoryInterface
     */
    protected $pikeRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PikeRepository $pikeRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PikeRepository $pikeRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->pikeRepository = $pikeRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $pikeId) {
                    /** @var \AHT\Pike\Model\Pike $pike */
                    $pike = $this->pikeRepository->getById($pikeId);
                    try {
                        $pike->setData(array_merge($pike->getData(), $postItems[$pikeId]));
                        $this->pikeRepository->save($pike);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBlockId(
                            $pike,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param BlockInterface $block
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBlockId(PikeInterface $pike, $errorText)
    {
        return '[Block ID: ' . $pike->getId() . '] ' . $errorText;
    }
}
