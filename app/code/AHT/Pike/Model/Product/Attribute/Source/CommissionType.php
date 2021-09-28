<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Pike\Model\Product\Attribute\Source;

class CommissionType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Choose Type'), 'value' => ''],
                ['label' => __('Percent'), 'value' => 'P'],
                ['label' => __('Fixed'), 'value' => 'F'],
            ];
        }
        return $this->_options;
    }
}
