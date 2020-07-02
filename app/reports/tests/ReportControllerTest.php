<?php

namespace Tests;

use App\Domain\Model\Report;
use PHPUnit\Framework\TestCase;

class ReportControllerTest extends TestCase
{

    /** @test */
    public function reportAdd() {
        $report = new Report();
        $result = $report->setTitle('test');

        // assert that your calculator added the numbers correctly!
        $this->assertEquals('test', $result->getTitle());
    }

}
