<?php

namespace app\core\services\Staff;

use app\core\dto\StaffAvailabilityDto;
use app\core\entities\Staff\StaffAvailability;
use app\core\entities\Staff\vo\StaffActivityType;
use app\core\interfaces\Staff\StaffAvailabilityRepositoryInterface;

class StaffAvailabilityService
{
    private $staffAvailabilityRepository;

    public function __construct(
        StaffAvailabilityRepositoryInterface $staffAvailabilityRepository
    ) {
        $this->staffAvailabilityRepository = $staffAvailabilityRepository;
    }

    public function get(int $id): StaffAvailability
    {
        return $this->staffAvailabilityRepository->get($id);
    }

    public function getByLogins(array $logins): array
    {
        return $this->staffAvailabilityRepository->getByLogins($logins);
    }


    public function getAvailabilityData(): StaffAvailabilityDto
    {
        $staffAvailabilitySorted = [];
        $staffAvailabilities = $this->staffAvailabilityRepository->getAll();

        foreach ($staffAvailabilities as $staffAvailability) {
            $staffAvailabilitySorted[$staffAvailability->getActivityType()->getValue()][] = $staffAvailability;
        }

        return new StaffAvailabilityDto($staffAvailabilitySorted);
    }

    public function create(StaffActivityType $staffActivityType, string $login): StaffAvailability
    {
        $model = StaffAvailability::create($staffActivityType, $login);
        $this->staffAvailabilityRepository->save($model);

        return $model;
    }

    public function remove(StaffAvailability $staffAvailability): void
    {
        $this->staffAvailabilityRepository->remove($staffAvailability);
    }
}
