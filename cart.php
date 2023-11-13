<?php
require_once ("common/page.php");
require_once ("common/a_content.php");
require_once ("common/db_helper.php");
class cart extends \common\a_content
{
    public function __construct()
    {
        parent::__construct();

        if(isset($_POST['product_id']))
        {
            $product_id = htmlspecialchars($_POST['product_id']);
            if(isset($_SESSION['order_id']))
            {
                $order_id = $_SESSION['order_id'];
            }
            else
            {
                $order_id = rand(10000, 100000);
                $_SESSION['order_id'] = $order_id;
            }

            $login = $_SESSION['user'];
            $user_id = \common\db_helper::get_instance()->get_user($login);
            \common\db_helper::get_instance()->add_order($user_id, $order_id, $product_id);
        }
    }

    function show_catalog()
    {
        $result = \common\db_helper::get_instance()->get_products();
        foreach ($result as $value)
        {
            ?>
            <form action="cart.php" method="POST">
                <label><?php print"{$value['id']} : {$value['name']}" ?></label>
                <input type="hidden" name="product_id" value="<?php print"{$value['id']}" ?>">
                <input type="submit" value="Добавить">
            </form>
            <?php
        }
    }

    function show_cart()
    {
        $login = $_SESSION['user'];
        $user_id = \common\db_helper::get_instance()->get_user($login);
        $result = \common\db_helper::get_instance()->get_order_content($user_id);
        foreach($result as $value)
        {
            ?>
            <div><?php print"{$value['name']} (количество: {$value['count']})" ?></div>
            <?php
        }
    }

    function show_content(): void
    {
        $this->show_catalog();
        $this->show_cart();
    }
}

$content = new cart();
new \common\page($content);