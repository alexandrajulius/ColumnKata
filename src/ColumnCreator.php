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
        $lastGroup = '';
        $finishedGroups = [];

        ['time', 'time', 'memory', 'time'];

        foreach ($columnDefinitions as $colDef) {
            if ($lastGroup === '') {
                $lastGroup = $colDef->columnGroup;
            }
            if ($lastGroup !== $colDef->columnGroup) {
                $finishedGroups[] = $lastGroup;
                $lastGroup = $colDef->columnGroup;
            }

            if (in_array($colDef->columnGroup, $finishedGroups, true)) {
                throw new Exception(
                    sprintf('A group for "%s" has already been created, and we encountered a duplicate group "%s" in "group"', $colDef->columnGroup, $lastGroup)
                );
            }

            if (array_key_exists($colDef->columnGroup, $groups)) {
                $groups[$colDef->columnGroup]->size++;
                continue;
            }
            $groups[$colDef->columnGroup] = new ColumnGroup($colDef->columnGroup, 1);

        }

        return array_values($groups);
    }
}
