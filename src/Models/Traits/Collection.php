<?php
namespace NickNickIO\Reepay\Models\Traits;

trait Collection
{
    private static $collection;

    /**
     * @param $collection
     * @param bool $paginated
     * @return array|object
     */
    public static function collection($collection, bool $paginated = false)
    {
        // Support pagination
        if ($paginated) {
            foreach($collection['content'] as $model) {
                self::$collection[] = new self($model);
            }
            return (object)[
                'page' => $collection['page'],
                'size' => $collection['size'],
                'count' => $collection['count'],
                'collection' => !empty(self::$collection) ? self::$collection : [],
                'total_elements' => $collection['total_elements'],
                'total_pages' => $collection['total_pages'],
            ];
        }

        // Return an ordinary collection of models.
        foreach($collection as $model) {
            self::$collection[] = new self($model);
        } return self::$collection;
    }

}
