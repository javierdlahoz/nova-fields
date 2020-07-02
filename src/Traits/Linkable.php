<?php

namespace Jdlabs\Nova\Fields\Traits;


use Laravel\Nova\Http\Requests\NovaRequest;
use Jdlabs\Nova\Fields\Link;
use Jdlabs\Nova\Fields\SparklineWithLink;

trait Linkable
{
    /**
     * RouterLink properties
     *
     * @var array
     */
    public $route = [];

    /**
     * @var string
     */
    public $url;

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
        }

        return $this;
    }

    /**
     * @param  string $url
     * @return $this
     */
    public function url(string $url)
    {
        $this->url = $url;
        return $this;
    }

}
