<?php

namespace App\UserController;

use App\Models\ToDo;

class UserController
{
    private string $name;

    public function index(): void
    {

        $tasks = [
            new ToDo("123", "feed the cat", ToDo::STATUS_CREATED),
            new ToDo("12223", "feed the dog", ToDo::STATUS_CREATED)
        ];
        require_once "app/Views/users.template.php";
    }

    public function create()
    {
        require_once "app/Views/create.template.php";
    }
    public function store()
    {
        var_dump($_POST);die;
    }
    public function getTitle(): string
    {
        return $this->name;
    }
}