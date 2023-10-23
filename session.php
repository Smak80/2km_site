<?php

require_once ("common/page.php");
require_once ("common/a_content.php");

class the_content extends \common\a_content {

    public function __construct(){
        parent::__construct();
        $this->get_user_data();
    }
    private function get_user_data(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['clear'])){
                unset($_SESSION['some_text']);
            } else {
                if (isset($_POST['some_text'])) $data = $_POST['some_text']; else $data = "";
                $_SESSION['some_text'] = htmlspecialchars($data);
            }
        }
    }
    public function show_content(): void
    {
        $data = '';
        if (isset($_SESSION['some_text'])) $data = $_SESSION['some_text'];
        ?>
        <form action="session.php" method="post">
            <label>
                <input type="text" value="<?php print $data;?>" placeholder="Введите тут что-нибудь" name="some_text">
            </label>
            <input type="submit">
        </form>
        <form method="post" action="session.php">
            <input type="hidden" name="clear" value="1">
            <input type="submit" value="Очистить">
        </form>
        <?php
    }
}

$content = new the_content();
new \common\page($content);
