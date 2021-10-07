<?php

namespace App\Models;

class ToDo
{
    private string $id;
    private string $description;
    private string $status;

    public const STATUS_CREATED = 'created';
    public const STATUS_COMPLETED = 'completed';

    private const STATUSES = [
        self::STATUS_CREATED,
        self::STATUS_COMPLETED,
    ];
    public function __construct(string $id, string $description, string $status)
    {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
    }


    public function setStatus(string $status): void
    {
        if (! in_array($status, self::STATUSES))
        {
            return;
        }
        $this->status = $status;
    }
    public function getId()
    {
        return $this->id;
    }

}
