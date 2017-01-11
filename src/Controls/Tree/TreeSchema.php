<?php

namespace SuperCMS\Controls\Tree;

class TreeSchema
{
    /** @var string */
    public $name;
    /** @var string */
    public $icon;
    /** @var bool */
    public $selected = false;
    /** @var bool */
    public $disabled = false;
    /** @var bool */
    public $opened = true;
    /** @var int  */
    public $uniqueID = 0;
    /** @var TreeSchema[] */
    public $children;

    public function setData(string $name, int $uniq, string $icon, bool $selected, bool $disabled, bool $opened,array $children = null)
    {
        $this->name = $name;
        $this->uniqueID = $uniq;
        $this->icon = $icon;
        $this->selected = $selected;
        $this->disabled = $disabled;
        $this->opened = $opened;
        $this->children = $children;
    }

    public static function createFromData(string $name, int $uniq, string $icon, bool $selected, bool $disabled, bool $opened,array $children = null)
    {
        $self = new self();
        $self->name = $name;
        $self->uniqueID = $uniq;
        $self->icon = $icon;
        $self->selected = $selected;
        $self->disabled = $disabled;
        $self->opened = $opened;
        $self->children = $children;

        return $self;
    }

    public function getDataJsonString()
    {
        return json_encode([
            'disabled' => $this->disabled,
            'icon' => $this->icon,
            'selected' => $this->selected,
            'opened' => $this->opened,
        ]);
    }
}
