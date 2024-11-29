<?php

namespace app\core\dto;

use app\core\entities\Staff\StaffAvailability;
use app\core\entities\Staff\vo\StaffActivityType;

class StaffAvailabilityDto
{

    /**
     * @var array
     */
    private $staffAvailabilities;

    /**
     * @param array $staffAvailabilities
     */
    public function __construct(
        array $staffAvailabilities
    ) {
        foreach ($staffAvailabilities as $staffAvailabilityType => $items) {
            $this->staffAvailabilities[$staffAvailabilityType] = array_filter($items, function ($item) {
                return $item instanceof StaffAvailability;
            });
        }
    }

    /**
     * @param StaffActivityType $staffActivityType
     * @return array|null
     */
    public function getByActivityType(StaffActivityType $staffActivityType): ?array
    {
        return $this->staffAvailabilities[$staffActivityType->getValue()] ?? [];
    }
}
