<?php

declare(strict_types=1);

use Archon\UIKit\Charts\Chart;
use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Charts</h2>';
echo '<p class="lead text-muted mb-4">Data visualization using Chart.js. Each chart is wrapped in a card and arranged in a 3-column grid.</p>';

// Include Chart.js
echo '<script src="/assets/js/chart.umd.js"></script>';

// Helper to format code
$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

// --- Chart Definitions & Snippets ---

// 1. Bar Chart
$salesChart = (new Chart('bar'))
    ->id('chartSales')
    ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'])
    ->addDataset('Sales', [12, 19, 3, 5, 2, 3], 'rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 235, 1)');

$salesCode = $snippet("new Chart('bar')\n    ->labels(['Jan', 'Feb', ...])\n    ->addDataset('Sales', [12, 19, ...]);");

// 2. Line Chart 1
$trendChart = (new Chart('line'))
    ->id('chartTrend')
    ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'])
    ->addDataset('Growth', [65, 59, 80, 81, 56, 55, 40], 'rgba(75, 192, 192, 0.5)', 'rgba(75, 192, 192, 1)');

$trendCode = $snippet("new Chart('line')\n    ->labels(['Jan', 'Feb', ...])\n    ->addDataset('Growth', [65, 59, ...]);");

// 3. Line Chart 2
$activityChart = (new Chart('line'))
    ->id('chartActivity')
    ->labels(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])
    ->addDataset('Active Users', [150, 230, 180, 320, 290, 140, 190], 'rgba(153, 102, 255, 0.5)', 'rgba(153, 102, 255, 1)');

$activityCode = $snippet("new Chart('line')\n    ->labels(['Mon', 'Tue', ...])\n    ->addDataset('Active', [150, ...]);");

// 4. Doughnut Chart
$voteChart = (new Chart('doughnut'))
    ->id('chartVotes')
    ->labels(['Red', 'Blue', 'Yellow'])
    ->addDataset('Votes', [300, 50, 100], ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)']);

$voteCode = $snippet("new Chart('doughnut')\n    ->labels(['Red', 'Blue', ...])\n    ->addDataset('Votes', [300, ...]);");

// 5. Pie Chart 1
$trafficChart = (new Chart('pie'))
    ->id('chartTraffic')
    ->labels(['Direct', 'Social', 'Referral'])
    ->addDataset('Traffic', [55, 30, 15], ['rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)']);

$trafficCode = $snippet("new Chart('pie')\n    ->labels(['Direct', ...])\n    ->addDataset('Traffic', [55, ...]);");

// 6. Pie Chart 2
$deviceChart = (new Chart('pie'))
    ->id('chartDevices')
    ->labels(['Desktop', 'Mobile', 'Tablet'])
    ->addDataset('Devices', [60, 35, 5], ['rgb(54, 162, 235)', 'rgb(255, 99, 132)', 'rgb(255, 205, 86)']);

$deviceCode = $snippet("new Chart('pie')\n    ->labels(['Desktop', ...])\n    ->addDataset('Devices', [60, ...]);");


// --- Grid Layout ---

echo (new Container(
    new Row(
        // Row 1
        (new Column((new Card($salesChart))->header('Monthly Sales')->footer($salesCode)))->md(4)->addClass('mb-4'),
        (new Column((new Card($trendChart))->header('Growth Trend')->footer($trendCode)))->md(4)->addClass('mb-4'),
        (new Column((new Card($activityChart))->header('Weekly Activity')->footer($activityCode)))->md(4)->addClass('mb-4'),

        // Row 2
        (new Column((new Card($voteChart))->header('Vote Distribution')->footer($voteCode)))->md(4)->addClass('mb-4'),
        (new Column((new Card($trafficChart))->header('Traffic Sources')->footer($trafficCode)))->md(4)->addClass('mb-4'),
        (new Column((new Card($deviceChart))->header('Device Usage')->footer($deviceCode)))->md(4)->addClass('mb-4')
    )
))->fluid();