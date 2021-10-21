<?php

declare(strict_types = 1);


final class ColumnCreator
{
    /**
     * @param array<ColumnDefinition> $columnDefinitions
     * @return array<ColumnGroup>
     */
    public function create(array $columnDefinitions): array
    {
        $groups = [];
        foreach ($columnDefinitions as $colDef) {
            if (array_key_exists($colDef->columnGroup, $groups)) {
                $groups[$colDef->columnGroup]->size++;
                continue;
            }
            $groups[$colDef->columnGroup] = new ColumnGroup($colDef->columnGroup, 1);
        }

        return array_values($groups);
    }
}
