<?php

class SqlModel {
    use Base_M;

    public function sql1($id) {
        $sql = 'select * from user where id = ' . $id . ';';
        return $this->db_link->table('user')->query($sql);
    }
}