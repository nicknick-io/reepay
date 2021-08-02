<?php
namespace NickNickIO\Reepay\Models;

class Model
{

    /**
     * Model constructor.
     * @param $properties
     */
    public function __construct($properties)
    {
        foreach ($properties as $key => $property) {
            $this->{$key} = $property;
        } $this->build();
    }

    /**
     * Translate the rules.
     */
    private function build()
    {
        foreach($this->rules as $rule => $model) {
            $this->determine($rule, $model);
        }
    }

    /**
     * @param string $rule
     * @param string $model
     */
    private function determine(string $rule, string $model) : void
    {
        $data = explode(':', $rule);

        if (count($data) === 2 && $data[1] === 'collection') {
            $this->translate($data[0], 'collection', $model);
            return;
        }

        $this->translate($data[0], 'single', $model);
    }

    /**
     * @param string $property
     * @param string $type
     * @param string $model
     */
    private function translate(string $property, string $type, string $model) : void
    {
        $data = $this->{$property};

        if ($type == 'single') {
            $this->{$property} = new $model($data);
            return;
        }

        $this->{$property} = (new $model($data))::collection($data);

    }

}
