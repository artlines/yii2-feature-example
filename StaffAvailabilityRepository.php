<?php

namespace app\core\repositories\Staff;

use app\core\entities\Staff\StaffAvailability;
use app\core\interfaces\Staff\StaffAvailabilityRepositoryInterface;
use app\core\repositories\NotFoundException;

class StaffAvailabilityRepository implements StaffAvailabilityRepositoryInterface
{
    public function get(int $id): StaffAvailability
    {
        if (!$model = StaffAvailability::findOne($id)) {
            throw new NotFoundException('Доступность сотрудника не найдена.');
        }

        return $model;
    }

    // todo добавить индекс по полю
    public function getByLogins(array $logins): array
    {
        return StaffAvailability::find()->where(['login' => $logins])->all();
    }

    public function getAll(): array
    {
        return StaffAvailability::find()->all();
    }

    public function save(StaffAvailability $model): void
    {
        if (!$model->save()) {
            throw new \RuntimeException(
                'Ошибка сохранения доступности сотрудника: ' . implode(', ', $model->getFirstErrors())
            );
        }
    }

    public function remove(StaffAvailability $model): void
    {
        if (!$model->delete()) {
            throw new \RuntimeException(
                'Ошибка удаления доступности сотрудника: ' . implode(', ', $model->getFirstErrors())
            );
        }
    }
}
