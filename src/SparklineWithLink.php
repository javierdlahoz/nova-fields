<?php


namespace Jdlabs\Nova\Fields;


use Laravel\Nova\Fields\Sparkline;
use Laravel\Nova\Http\Requests\NovaRequest;
use Jdlabs\Nova\Fields\Traits\Linkable;

class SparklineWithLink extends Sparkline
{
    use Linkable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'sparkline-with-link';

    /**
     * Prepare the field element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'route' => (!$this->route && $this->value) ? $this->value : $this->route,
            'url' => $this->url
        ]);
    }
}
