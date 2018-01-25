<?php

namespace MongoDB\Tests\Operation;

use MongoDB\Driver\BulkWrite;
use MongoDB\Operation\CreateCollection;
use MongoDB\Operation\CreateIndexes;
use MongoDB\Operation\DropCollection;
use MongoDB\Operation\Find;
use MongoDB\Tests\CommandObserver;
use stdClass;

class FindFunctionalTest extends FunctionalTestCase
{
    public function testDefaultReadConcernIsOmitted()
    {
        (new CommandObserver)->observe(
            function() {
                $operation = new Find(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    [],
                    ['readConcern' => $this->createDefaultReadConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function(stdClass $command) {
                $this->assertObjectNotHasAttribute('readConcern', $command);
            }
        );
    }

    public function testHintOption()
    {
        $bulkWrite = new BulkWrite;
        $bulkWrite->insert(['_id' => 1, 'x' => 1]);
        $bulkWrite->insert(['_id' => 2, 'x' => 2]);
        $bulkWrite->insert(['_id' => 3, 'y' => 3]);
        $this->manager->executeBulkWrite($this->getNamespace(), $bulkWrite);

        $createIndexes = new CreateIndexes($this->getDatabaseName(), $this->getCollectionName(), [
            ['key' => ['x' => 1], 'sparse' => true, 'name' => 'sparse_x'],
            ['key' => ['y' => 1]],
        ]);
        $createIndexes->execute($this->getPrimaryServer());

        $hintsUsingSparseIndex = [
            ['x' => 1],
            'sparse_x',
        ];

        foreach ($hintsUsingSparseIndex as $hint) {
            $operation = new Find($this->getDatabaseName(), $this->getCollectionName(), [], ['hint' => $hint]);
            $cursor = $operation->execute($this->getPrimaryServer());

            $expectedDocuments = [
                (object) ['_id' => 1, 'x' => 1],
                (object) ['_id' => 2, 'x' => 2],
            ];

            $this->assertEquals($expectedDocuments, $cursor->toArray());
        }

        $hintsNotUsingSparseIndex = [
            ['_id' => 1],
            ['y' => 1],
            'y_1',
        ];

        foreach ($hintsNotUsingSparseIndex as $hint) {
            $operation = new Find($this->getDatabaseName(), $this->getCollectionName(), [], ['hint' => $hint]);
            $cursor = $operation->execute($this->getPrimaryServer());

            $expectedDocuments = [
                (object) ['_id' => 1, 'x' => 1],
                (object) ['_id' => 2, 'x' => 2],
                (object) ['_id' => 3, 'y' => 3],
            ];

            $this->assertEquals($expectedDocuments, $cursor->toArray());
        }
    }

    /**
     * @dataProvider provideTypeMapOptionsAndExpectedDocuments
     */
    public function testTypeMapOption(array $typeMap, array $expectedDocuments)
    {
        $this->createFixtures(3);

        $operation = new Find($this->getDatabaseName(), $this->getCollectionName(), [], ['typeMap' => $typeMap]);
        $cursor = $operation->execute($this->getPrimaryServer());

        $this->assertEquals($expectedDocuments, $cursor->toArray());
    }

    public function provideTypeMapOptionsAndExpectedDocuments()
    {
        return [
            [
                ['root' => 'array', 'document' => 'array'],
                [
                    ['_id' => 1, 'x' => ['foo' => 'bar']],
                    ['_id' => 2, 'x' => ['foo' => 'bar']],
                    ['_id' => 3, 'x' => ['foo' => 'bar']],
                ],
            ],
            [
                ['root' => 'object', 'document' => 'array'],
                [
                    (object) ['_id' => 1, 'x' => ['foo' => 'bar']],
                    (object) ['_id' => 2, 'x' => ['foo' => 'bar']],
                    (object) ['_id' => 3, 'x' => ['foo' => 'bar']],
                ],
            ],
            [
                ['root' => 'array', 'document' => 'stdClass'],
                [
                    ['_id' => 1, 'x' => (object) ['foo' => 'bar']],
                    ['_id' => 2, 'x' => (object) ['foo' => 'bar']],
                    ['_id' => 3, 'x' => (object) ['foo' => 'bar']],
                ],
            ],
        ];
    }

    public function testMaxAwaitTimeMS()
    {
        if (version_compare($this->getServerVersion(), '3.2.0', '<')) {
            $this->markTestSkipped('maxAwaitTimeMS option is not supported');
        }

        $maxAwaitTimeMS = 10;

        // Create a capped collection.
        $databaseName = $this->getDatabaseName();
        $cappedCollectionName = $this->getCollectionName();
        $cappedCollectionOptions = [
            'capped' => true,
            'max' => 100,
            'size' => 1048576,
        ];

        $operation = new CreateCollection($databaseName, $cappedCollectionName, $cappedCollectionOptions);
        $operation->execute($this->getPrimaryServer());

        // Insert documents into the capped collection.
        $bulkWrite = new BulkWrite(['ordered' => true]);
        $bulkWrite->insert(['_id' => 1]);
        $result = $this->manager->executeBulkWrite($this->getNamespace(), $bulkWrite);

        $operation = new Find($databaseName, $cappedCollectionName, [], ['cursorType' => Find::TAILABLE_AWAIT, 'maxAwaitTimeMS' => $maxAwaitTimeMS]);
        $cursor = $operation->execute($this->getPrimaryServer());
        $it = new \IteratorIterator($cursor);

        // Make sure we await results for no more than the maxAwaitTimeMS.
        $it->rewind();
        $it->next();
        $startTime = microtime(true);
        $it->next();
        $this->assertGreaterThanOrEqual($maxAwaitTimeMS * 0.001, microtime(true) - $startTime);
    }

    /**
     * Create data fixtures.
     *
     * @param integer $n
     */
    private function createFixtures($n)
    {
        $bulkWrite = new BulkWrite(['ordered' => true]);

        for ($i = 1; $i <= $n; $i++) {
            $bulkWrite->insert([
                '_id' => $i,
                'x' => (object) ['foo' => 'bar'],
            ]);
        }

        $result = $this->manager->executeBulkWrite($this->getNamespace(), $bulkWrite);

        $this->assertEquals($n, $result->getInsertedCount());
    }
}
