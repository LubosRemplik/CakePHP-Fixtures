<?php
namespace Fixtures\Shell;

use Cake\Console\Shell;
use Cake\Database\Schema\Table;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Fixtures shell command.
 */
class FixturesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser
            ->addSubcommand('createTable', [
                'Creates table which is defined in fixture argument',
                'parser' => [
                    'arguments' => [
                        'fixture' => [
                            'required' => true
                        ],
                    ],
                    'options' => [
                        'table' => [
                            'short' => 't',
                            'help' => 'Target table (default: fixture table name)'
                        ]
                    ]
                ]
            ])
            ->addSubcommand('insert', [
                'Inserts data into table which is defined in fixture argument',
                'parser' => [
                    'arguments' => [
                        'fixture' => [
                            'required' => true
                        ]
                    ],
                    'options' => [
                        'table' => [
                            'short' => 't',
                            'help' => 'Target table (default: fixture table name)'
                        ]
                    ]
                ]
            ]);

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());

        return true;
    }

    /**
     * Creates table which is defined in fixture argument.
     *
     * @param string $fixture Fixture class with full namespace
     * @return bool Success
     */
    public function createTable($fixture)
    {
        $db = ConnectionManager::get('default');
        $object = new $fixture();
        $fields = [];
        foreach ($object->fields as $key => $value) {
            if (substr($key, 0, 1) != '_') {
                $fields[$key] = $value;
            }
        }
        $tableName = $object->table;
        if (!empty($this->params['table'])) {
            $tableName = $this->params['table'];
        }
        $table = new Table($tableName, $fields);
        if (!empty($object->fields['_constraints'])) {
            foreach ($object->fields['_constraints'] as $name => $attrs) {
                $table->addConstraint($name, $attrs);
            }
        }
        if (!empty($object->fields['_indexes'])) {
            foreach ($object->fields['_indexes'] as $name => $attrs) {
                $table->addIndex($name, $attrs);
            }
        }
        $sql = $table->createSql($db);
        foreach ($sql as $stmt) {
            if (!$db->execute($stmt)) {
                $this->error('Statement error.');
            }
        }
        $this->out(sprintf('Table %s created.', $tableName));

        return true;
    }

    /**
     * Inserts data into table which is defined in fixture argument.
     *
     * @param string $fixture Fixture class with full namespace
     * @return bool Success
     */
    public function insert($fixture)
    {
        $object = new $fixture();
        $tableName = $object->table;
        if (!empty($this->params['table'])) {
            $tableName = $this->params['table'];
        }
        $table = TableRegistry::get($tableName);
        if (empty($object->records)) {
            $this->error('No records found in fixture');
        }
        $query = $table->query();
        $query->insert(array_keys($object->records[0]));
        foreach ($object->records as $record) {
            $query->values($record);
        }
        if ($query->execute()) {
            $this->out(sprintf('Insert executed'));

            return true;
        }
        $this->error('Insert cannot be executed');
    }
}
