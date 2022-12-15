<?php

class SqlController extends Base_UC {

    public function sql1Action() {
        $id = $_GET['id'];
        $result = SqlModel::getInstance()->sql1($id);
        $this->success('', $result);
    }
}
