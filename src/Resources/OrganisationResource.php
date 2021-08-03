<?php
namespace NickNickIO\Reepay\Resources;

use NickNickIO\Reepay\Models\Organisation;

class OrganisationResource extends Resource
{
    public function get()
    {
        return new Organisation($this->connection->get('organisation'));
    }
}
