<?php
require_once ("common/page.php");
require_once ("common/a_content.php");

class second extends \common\a_content {
    public function show_content(): void
    {
        print ('Здесь будет основной контент второй страницы');
    }
}

$content = new second();
new \common\page($content);