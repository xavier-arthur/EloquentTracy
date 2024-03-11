<?php

namespace Arthurx\EloquentTracy;

class EloquentTracy implements \Tracy\IBarPanel
{
    public function __construct(
        private string $title = 'DB'
    ) { }

    public function getPanel()
    {
        $queryLog = \Illuminate\Database\Capsule\Manager::connection()->getRawQueryLog();
        $totalQueries = count($queryLog);
        $totalTime = array_column($queryLog, 'time');
        $totalTime = array_reduce($totalTime, function($carry, $current) {
            return $carry + (float) $current;
        }, 0.0);
        $log = '';

        foreach ($queryLog as $v) {
            $log .= "<p><b>QUERY:&nbsp;</b>{$v['raw_query']}<br><b>TIME:&nbsp;</b>{$v['time']}</p>";
        }

        return "<h1>Database</h1>
        <div class=\"tracy-inner\">
            <div class=\"tracy-inner-container\">
                <b>{$totalQueries} queries performed</b> in <b>{$totalTime}ms</b>
                <pre>{$log}</pre>
            </div>
        </div>";
    }

    public function getTab()
    {
        $svg = file_get_contents(__DIR__ . '/assets/database.svg');

        return "<span title=\"Database queries\">
            {$svg}
            <span class=\"tracy-label\">{$this->title}</span>
        </span>";
    }
}