<?php

use App\Models\ToDo;
class UserCollection
{
    private array $users = [];

    public function __construct(array $users)
    {
        foreach ($users as $user)
        {
            $this->add($user);
        }
    }
    public function add(ToDo $user)
    {
        $this->users[] = $user;
    }
}