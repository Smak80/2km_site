<?php
require_once ("common/page.php");
require_once ("common/a_content.php");

class index extends \common\a_content {
    public function show_content(): void{
        print ('Здесь будет основной контент главной страницы');
    }
}

$content = new index();
new \common\page($content);