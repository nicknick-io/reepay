<?php
namespace NickNickIO\Reepay\Models\Traits;

trait Collection
{
    private static $collection;

    /**
     * @param $collection
     * @param bool $paginated
     * @param array|null $multi_model
     * @return array|object
     */
    public static function collection($collection, bool $paginated = false, array $multi_model = [])
    {
        // Support pagination
        if ($paginated) {
            return self::paginated($collection);
        }

        // Support multiple models in one request.
        if (!empty($multi_model)) {
            return self::multi_model($collection, $multi_model);
        }

        // Return an ordinary collection of models.
        foreach($collection as $model) {
            self::$collection[] = new self($model);
        } return self::$collection;
    }

    /**
     * @param $collection
     * @return object
     */
    private static function paginated($collection)
    {
        // Add a new model instance of each content entry.
        foreach($collection['content'] as $model) {
            self::$collection[] = new self($model);
        }

        // Return the contents with pagination information.
        return (object)[
            'page' => $collection['page'],
            'size' => $collection['size'],
            'count' => $collection['count'],
            'collection' => !empty(self::$collection) ? self::$collection : [],
            'total_elements' => $collection['total_elements'],
            'total_pages' => $collection['total_pages'],
        ];
    }

    /**
     * @param $collection
     * @param array $multi_model
     * @return array
     */
    private static function multi_model($collection, array $multi_model)
    {
        foreach ($multi_model as $key => $item) {
            if (!empty($collection[$key])) {
                $collection = $item::collection($collection[$key]);
                foreach ($collection as $model) {
                    self::$collection[] = $model;
                }
            }
        } return self::$collection;
    }

}
