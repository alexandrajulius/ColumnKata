<?php

declare(strict_types = 1);

namespace Tests;

use ColumnCreator;
use ColumnDefinition;
use ColumnGroup;
use Generator;
use PHPUnit\Framework\TestCase;

final class ColumnCreatorTest extends TestCase
{
    /**
     * @dataProvider provide_test_cases
     */
    public function test_column_creator(array $columnDefinitions, array $expectedColumnGroups): void
    {
        $columnCreator = new ColumnCreator();

        self::assertEquals($expectedColumnGroups, $columnCreator->create($columnDefinitions));
    }

    public function provide_test_cases(): Generator
    {
        yield 'passing no columns returns no groups' => [[], []];
        yield 'passing one column returns a group with size 1' => [
            [new ColumnDefinition('php71', 'time')],
            [new ColumnGroup('time', 1)],
        ];
        yield 'passing two columns with the same group returns a group of size 2' => [
            [
                new ColumnDefinition('php71', 'time'),
                new ColumnDefinition('php74', 'time')
            ],
            [new ColumnGroup('time', 2)],
        ];
        yield 'passing 4 columns with 2 consecutive groups returns two groups of size 2' => [
            [
                new ColumnDefinition('php71', 'time'),
                new ColumnDefinition('php74', 'time'),
                new ColumnDefinition('php71', 'memory'),
                new ColumnDefinition('php74', 'memory')
            ],
            [
                new ColumnGroup('time', 2),
                new ColumnGroup('memory', 2)
            ],
        ];
    }
}
