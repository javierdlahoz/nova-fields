<?php

namespace Jdlabs\Nova\Fields;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\KeyValue as LaravelKeyValue;

class KeyValue extends LaravelKeyValue
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'jdlabs-key-value';

    /**
     * Mapped fields to be used
     *
     * @var array
     */
    public $mappedFields = [];

    /**
     * Map fields for json entry
     *
     * @param array $fields
     * @return void
     */
    public function map(array $fields)
    {
        $this->mappedFields = $fields;
        return $this;
    }

    /**
     * Prepare the field element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $this->value = is_array($this->value) ? $this->value : json_decode($this->value, true);
        collect($this->mappedFields)->pluck('key')->each(function ($key) {
            if (!Arr::has($this->value, $key, null)) {
                Arr::set(
                    $this->value,
                    $key,
                    Arr::get(
                        collect($this->mappedFields)->where('key', $key)->first(),
                        'options.default',
                        null
                    )
                );
            }
        });

        return array_merge(parent::jsonSerialize(), [
            'keyLabel' => $this->keyLabel ?? __('Key'),
            'valueLabel' => $this->valueLabel ?? __('Value'),
            'actionText' => $this->actionText ?? __('Add row'),
            'mappedFields' => $this->mappedFields ?? [],
            'value' => is_array($this->value) ? $this->value : json_decode($this->value)
        ]);
    }
}
