<?php

namespace Jdlabs\Nova\Fields;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Jdlabs\Nova\Fields\Traits\Linkable;

class Link extends Field
{
    use Linkable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'jdlabs-link';

    /**
     * Html to be rendered
     *
     * @var string
     */
    public $html = '<i class="fa fa-area-chart fa-fw"></i>';

    /**
     * @var callable
     */
    private $resolvableRoute;

    /**
     * Sets the html
     *
     * @param  string $html
     * @return void
     */
    public function html(string $html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Renders a blade partial
     *
     * @param  $blade
     * @return void
     */
    public function render($fn)
    {
        $this->html = $fn();
        return $this;
    }

    /**
     * Renders a partial
     *
     * @param  string $partial
     * @param  array $args
     * @return void
     */
    public function view(string $partial, $args = [])
    {
        $this->html = view($partial, $args)->render();
        return $this;
    }

    /**
     * Resolve the field's value.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        if (is_callable($this->resolvableRoute)) {
            $this->route = call_user_func($this->resolvableRoute, app(NovaRequest::class), $resource);
        }

        parent::resolve($resource, $attribute);
    }

    /**
     * Sets the route to be used in Vue router-link, see https://router.vuejs.org/api/#router-link
     * for further details
     *
     * @param  $route
     * @return $this
     */
    public function route($route)
    {
        if (is_array($route)) {
            $this->route = $route;
        } else {
            $this->resolvableRoute = $route;
        }

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
            'html' => $this->html,
            'route' => (!$this->route && $this->value) ? $this->value : $this->route,
            'url' => $this->url
        ]);
    }
}
