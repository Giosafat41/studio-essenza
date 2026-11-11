
<?php

require_once __DIR__ . '/../StartSmarty.php';

class VInfo {

    protected $smarty;

    public function __construct() {
        $startSmarty = new StartSmarty();
        $this->smarty = $startSmarty->getSmarty();
    }

    public function mostraTariffe() {

        $this->smarty->assign('titolo', 'Le nostre tariffe');

        $this->smarty->display('tariffe.tpl');
    }

}
