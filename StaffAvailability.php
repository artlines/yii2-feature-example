<?php

namespace app\core\entities\Staff;

use app\core\entities\Staff\data\StaffAvailabilityData;
use app\core\entities\Staff\vo\StaffActivityType;

class StaffAvailability extends StaffAvailabilityData
{
    public static function create(
        StaffActivityType $activityType,
        string $login
    ): self {
        $model = new static();

        $model->activity_type = $activityType->getValue();
        $model->login = $login;

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getActivityType(): StaffActivityType
    {
        return new StaffActivityType($this->activity_type);
    }
}
