<?php

namespace app\core\entities\Staff\vo;

class StaffActivityType
{
    public const PROJECT_TM = 'project_tm';
    public const PROJECT_PRODUCT = 'project_product';
    public const PROJECT_OUTSTAFF = 'project_outstaff';

    private static $values = [
        self::PROJECT_TM,
        self::PROJECT_PRODUCT,
        self::PROJECT_OUTSTAFF
    ];

    private static $labels = [
        self::PROJECT_TM => 'ТМ',
        self::PROJECT_PRODUCT => 'Продукт',
        self::PROJECT_OUTSTAFF => 'Outstaff'
    ];

    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, self::$values)) {
            throw new \RuntimeException('Wrong value: ' . $value);
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLabel(): string
    {
        return self::$labels[$this->value] ?? '-';
    }

    public static function getLabels(): array
    {
        return self::$labels;
    }

    public static function getValues(): array
    {
        return self::$values;
    }
}
