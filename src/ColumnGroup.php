<?php

declare(strict_types = 1);


final class ColumnGroup
{
    public string $name;

    public int $size;

    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }
}
