<?php
require_once ("common/page.php");
require_once ("common/a_content.php");

class index extends \common\a_content {
    public function show_content(): void{
        print "Контент главной страницы";
    }
}

$content = new index();
new \common\page($content);