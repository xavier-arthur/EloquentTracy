<?php

class EloquentTracy implements \Tracy\IBarPanel
{
    public function getPanel()
    {
        $svg=  file_get_contents(realpath(__DIR__ . PHP_EOL . 'assets' . PHP_EOL . 'database.sv'));

        return "<span title=\"Explaining tooltip\">
            {$svg}
            <span class=\"tracy-label\">Title</span>
        </span>";
    }

    public function getTab()
    {
        return "<h1>Title</h1>
        <div class=\"tracy-inner\">
            <div class=\"tracy-inner-container\">
                ... content ...
            </div>
        </div>";
    }
}