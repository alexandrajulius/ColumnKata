<?php

declare(strict_types = 1);

final class ColumnDefinition
{
    public string $columnName;

    public string $columnGroup;

    public function __construct(string $columnName, string $columnGroup)
    {
        $this->columnName = $columnName;
        $this->columnGroup = $columnGroup;
    }
}
