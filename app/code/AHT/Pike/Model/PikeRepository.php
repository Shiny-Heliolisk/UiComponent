<?php
namespace AHT\Pike\Model;
use AHT\Pike\Api\Data\PikeInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use AHT\Pike\Model\ResourceModel\Pike as ResourceModelPike;
use Magento\Framework\Exception\NoSuchEntityException;
use AHT\Pike\Model\PikeFactory;

class PikeRepository  implements \AHT\Pike\Api\PikeRepositoryInterface
{
    /**
     * @var ResourceModelPike
     */
    protected $resource;
    protected $pikeFactory;
    public function __construct(
        ResourceModelPike $resource,
        PikeFactory $pikeFactory
        
    ) {
        $this->pikeFactory = $pikeFactory;
        $this->resource = $resource;
    }
   /**
     * Save Block data
     *
     * @param \AHT\Pike\Api\Data\BlockInterface $block
     * @return Pike
     * @throws CouldNotSaveException
     */
    
    public function save(PikeInterface $block)
    {
        // if (empty($block->getStoreId())) {
        //     $block->setStoreId($this->storeManager->getStore()->getId());
        // }

        try {
            $this->resource->save($block);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $block;
    }

    /**
     * Load Block data by given Block Identity
     *
     * @param string $blockId
     * @return Block
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($blockId)
    {
        $block = $this->pikeFactory->create();
        $this->resource->load($block, $blockId);
        if (!$block->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $blockId));
        }
        return $block;
    }
}
