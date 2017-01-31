<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Analyzer;

class AnalyzerTest extends TestCase
{
    /**
     * Temporary result file location
     */
    const REPORT_FILE = 'results/phpunit.html';

    /**
     * Test analyzer can export the report
     */
    public function testItCanCreateReports()
    {
        $this->analyzer = new Analyzer(10);
        $this->analyzer->analyzeAlgorithms();
        $this->analyzer->createReport(self::REPORT_FILE);

        $this->assertFileExists(self::REPORT_FILE);

        $content = file_get_contents(self::REPORT_FILE);
        $this->assertContains("arrayToDataTable([[", $content);
        
        if (file_exists(self::REPORT_FILE)) {
            unlink(self::REPORT_FILE);
        }
    }

    /**
     * Test analyzer can create report from a
     * huge amount of results by chunking them.
     */
    public function testItCanCreateReportsFromChunkedData()
    {
        $this->analyzer = new Analyzer(200);
        $this->analyzer->analyzeAlgorithms();
        $this->analyzer->createReport(self::REPORT_FILE);

        $this->assertFileExists(self::REPORT_FILE);
        
        if (file_exists(self::REPORT_FILE)) {
            unlink(self::REPORT_FILE);
        }
    }
}
