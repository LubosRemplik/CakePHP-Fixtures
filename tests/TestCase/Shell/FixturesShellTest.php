<?php
namespace Fixtures\Test\TestCase\Shell;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Fixtures\Shell\FixturesShell;

/**
 * Fixtures\Shell\FixturesShell Test Case
 */
class FixturesShellTest extends TestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \Fixtures\Shell\FixturesShell
     */
    public $FixturesShell;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->FixturesShell = new FixturesShell($this->io);
        $this->FixturesShell->db = ConnectionManager::get('test');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FixturesShell);

        parent::tearDown();
    }

    /**
     * Test createTable method
     *
     * @return void
     */
    public function testCreateTable()
    {
        $result = $this->FixturesShell->runCommand([
            'createTable', 
            '\Fixtures\Test\Fixture\ArticlesFixture',
        ]);

        // Shell returns true on success
        $this->AssertTrue($result);

        // Table find all returns ResultSet on success
        $table = TableRegistry::get('Articles', ['connection' => $this->FixturesShell->db]);
        $this->AssertInstanceOf('Cake\ORM\ResultSet', $table->find()->all());
    }

    /**
     * Method: testInsert
     *
     * @depends testCreateTable
     * @return void
     */
    public function testInsert()
    {
        $result = $this->FixturesShell->runCommand([
            'insert', 
            '\Fixtures\Test\Fixture\ArticlesFixture',
        ]);

        // Shell returns true on success
        $this->AssertTrue($result);

        // Fixture has 3 items
        $table = TableRegistry::get('Articles', ['connection' => $this->FixturesShell->db]);
        $count = $table->find()->count();
        $this->AssertSame(3, $count);
    }

    /**
     * Method: testCreateTableWithTableOption
     *
     * @return void
     */
    public function testCreateTableWithTableOption()
    {
        $result = $this->FixturesShell->runCommand([
            'createTable', 
            '\Fixtures\Test\Fixture\ArticlesFixture',
            '--table',
            'posts'
        ]);

        // Shell returns true on success
        $this->AssertTrue($result);

        // Table find all returns ResultSet on success
        $table = TableRegistry::get('Posts', ['connection' => $this->FixturesShell->db]);
        $this->AssertInstanceOf('Cake\ORM\ResultSet', $table->find()->all());
    }

    /**
     * Method: testInsertWithTableOption
     *
     * @depends testCreateTableWithTableOption
     * @return void
     */
    public function testInsertWithTableOption()
    {
        $result = $this->FixturesShell->runCommand([
            'insert', 
            '\Fixtures\Test\Fixture\ArticlesFixture',
            '--table',
            'posts'
        ]);

        // Shell returns true on success
        $this->AssertTrue($result);

        // Fixture has 3 items
        $table = TableRegistry::get('Posts', ['connection' => $this->FixturesShell->db]);
        $count = $table->find()->count();
        $this->AssertSame(3, $count);
    }
}
