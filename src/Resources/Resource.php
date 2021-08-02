<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Connection;

class Resource
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
