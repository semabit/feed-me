<?php

namespace semabit\feedme\fields;

use Cake\Utility\Hash;
use semabit\feedme\base\Field;
use semabit\feedme\base\FieldInterface;
use semabit\feedme\helpers\DateHelper;
use craft\fields\Date as DateField;

/**
 *
 * @property-read string $mappingTemplate
 */
class Date extends Field implements FieldInterface
{
    // Properties
    // =========================================================================

    /**
     * @var string
     */
    public static string $name = 'Date';

    /**
     * @var string
     */
    public static string $class = DateField::class;

    // Templates
    // =========================================================================

    /**
     * @inheritDoc
     */
    public function getMappingTemplate(): string
    {
        return 'feed-me/_includes/fields/date';
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritDoc
     */
    public function parseField(): mixed
    {
        $value = $this->fetchValue();

        if ($value === null) {
            return null;
        }

        $formatting = Hash::get($this->fieldInfo, 'options.match');

        $dateValue = DateHelper::parseString($value, $formatting);

        if ($dateValue) {
            return $dateValue;
        }

        return $value;
    }
}
