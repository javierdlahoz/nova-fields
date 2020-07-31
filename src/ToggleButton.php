<?php


namespace Jdlabs\Nova\Fields;


use Laravel\Nova\Fields\Boolean;

class ToggleButton extends Boolean
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'toggle-button';

    /**
     * @var null
     */
    public $uncheckedText = null;

    /**
     * @var null
     */
    public $checkedText = null;

    /**
     * Set the unchecked text to show
     *
     * @param  string $text
     * @return $this
     */
    public function uncheckedText(string $text)
    {
        $this->uncheckedText = $text;
        return $this;
    }

    /**
     * Set the checked text to show
     *
     * @param  string $text
     * @return $this
     */
    public function checkedText(string $text)
    {
        $this->checkedText = $text;
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
            'uncheckedText' => $this->uncheckedText,
            'checkedText' => $this->checkedText
        ]);
    }
}
