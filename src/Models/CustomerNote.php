<?php
namespace NickNickIO\Reepay\Models;

use NickNickIO\Reepay\Models\Traits\Collection;

class CustomerNote extends Model
{
    use Collection;

    public string $note;
    public string $id;
    public string $created;
    public string $user_name;
    public string $user_email;
}
