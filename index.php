<?php
require_once ("common/page.php");
require_once ("common/a_content.php");

class index extends \common\a_content {
    public function show_content(): void{
        $text = "один+два=три";
        $keys = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $filtered_text = mb_ereg_replace("[^a-zа-я]", "", $text);
        //print($filtered_text);
        $arr = array_combine(
            $keys,
            array_pad(
                array_unique( mb_str_split($filtered_text) ),
                10,
                ''
            )
        );
        $tarr = array('о'=>1,'д'=>2);
        $str=strtr($text,$tarr);
        print ($str);
        $res = eval("return 0123+245==368;");
        //print("<br>Результат: $res<br>");
        //print_r($arr);
    }
}

$content = new index();
new \common\page($content);