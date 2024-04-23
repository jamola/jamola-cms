<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once 'src/Entity.php';
require_once 'modules/page/models/Page.php';

class FakeStmt {
  function execute() {}
  function fetchAll() {
      return [
        ['id' => 12, 'title' => 'Fake title', 'content' => 'Fake content'],
        ['id' => 2, 'title' => 'Fake title 2', 'content' => 'Fake content 2']
      ];

  }
}

class FakeDatabaseConnection {
  function prepare() {
    return new FakeStmt();

  }
}

final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $results = $page->findAll();
        $this->assertEquals(2, count($results));
        $this->assertEquals(12, $results[0]->id);
    }


    public function testFindBy(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $page->findBy('id', 12);

        $this->assertEquals(12, $page->id);
    }
}

