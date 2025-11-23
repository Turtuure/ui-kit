<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Charts;

use Archon\UIKit\Charts\Chart;
use PHPUnit\Framework\TestCase;

final class ChartTest extends TestCase
{
    public function testChartRendersCanvasAndScript(): void
    {
        $chart = new Chart('bar');
        $chart->id('testChart');
        $html = $chart->render();
        
        $this->assertStringContainsString('<canvas id="testChart"', $html);
        $this->assertStringContainsString('<script>', $html);
        $this->assertStringContainsString('new Chart(ctx,', $html);
        $this->assertStringContainsString('"type":"bar"', $html);
    }

    public function testChartData(): void
    {
        $chart = (new Chart('line'))
            ->labels(['Jan', 'Feb'])
            ->addDataset('Sales', [10, 20]);
        $html = $chart->render();
        
        $this->assertStringContainsString('"labels":["Jan","Feb"]', $html);
        $this->assertStringContainsString('"label":"Sales"', $html);
        $this->assertStringContainsString('"data":[10,20]', $html);
    }
}
