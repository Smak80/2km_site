<?php
require_once ("common/page.php");
require_once ("common/a_content.php");

class index extends \common\a_content {
    public function show_content(): void{
        $text = "один+два=три";
        $filtered_text = mb_ereg_replace("[^a-zа-я]", "", $text);
        print($filtered_text);
        $arr = array_unique(mb_str_split($filtered_text));
        print_r($arr);
    }
}

$content = new index();
new \common\page($content);