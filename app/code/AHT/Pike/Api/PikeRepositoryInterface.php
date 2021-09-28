<?php
namespace AHT\Pike\Api;

interface PikeRepositoryInterface
{
        /**
     * Save block.
     *
     * @param \AHT\Pike\Api\Data\PikeInterface $block
     * @return \AHT\Pike\Api\Data\PikeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\PikeInterface $block);

    /**
     * Retrieve block.
     *
     * @param int $blockId
     * @return \AHT\Pike\Api\Data\PikeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($blockId);

    
}
