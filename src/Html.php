<?php

namespace Jdlabs\Nova\Fields;

use Laravel\Nova\Fields\Field;

class Html extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'jdlabs-html';

    /**
     * @var string
     */
    public $defaultEditor = 'html';

    /**
     * @var bool
     */
    public $toggleEnabled = true;

    /**
     * Sets the default editor
     *
     * @param  string $defaultEditor
     * @return $this
     */
    public function defaultEditor(string $defaultEditor = 'html')
    {
        $this->defaultEditor = $defaultEditor;
        return $this;
    }

    /**
     * Sets toggle Enabled variable
     *
     * @param  bool $toggleEnabled
     * @return $this
     */
    public function toggleEnabled(bool $toggleEnabled = true)
    {
        $this->toggleEnabled = $toggleEnabled;
        return $this;
    }

    /**
     * Prepare the field element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'keyLabel' => $this->keyLabel ?? __('Html'),
            'valueLabel' => $this->valueLabel ?? __('Html'),
            'default_editor' => $this->defaultEditor,
            'toggle_enabled' => $this->toggleEnabled
        ]);
    }
}
