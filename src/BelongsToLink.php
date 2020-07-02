<?php

namespace Jdlabs\Nova\Fields;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ResourceRelationshipGuesser;
use Laravel\Nova\Http\Requests\NovaRequest;

class BelongsToLink extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'jdlabs-link';

    /**
     * RouterLink properties
     *
     * @var array
     */
    public $route = [];

    /**
     * Html to be rendered
     *
     * @var string
     */
    public $html = '';

    /**
     * Relation between resource and attribute
     *
     * @var Relation
     */
    public $relation;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  string|null  $resource
     * @return void
     */
    public function __construct($name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute);

        $this->resourceClass = $resource;
        $this->resourceName = $resource::uriKey();
        $this->belongsToRelationship = $this->attribute;
        $this->singularLabel = $name;
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
        $this->relation = $resource->{$this->attribute}();

        if ($this->relation->exists()) {
            $this->html = $resource->{$attribute}->{$this->resourceClass::$title};
            $this->route = [
                'path' => "/resources/{$this->resourceName}/{$resource->{$attribute}->id}"
            ];
        }
    }

    /**
     * Return the sortable uri key for the field.
     *
     * @return string
     */
    public function sortableUriKey()
    {
        return $this->getRelationForeignKeyName($this->relation);
    }

    /**
     * Get foreign key name for relation.
     *
     * @param  \Illuminate\Database\Eloquent\Relations\Relation $relation
     * @return string
     */
    protected function getRelationForeignKeyName(Relation $relation)
    {
        return $relation->getForeignKeyName();
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
            'route' => $this->route
        ]);
    }
}
