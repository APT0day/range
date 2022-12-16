<?php

class SqlModel {
    use Base_M;

    public function sql1($id) {
        $sql = 'select * from user where id = ' . $id . ';';
        // echo "当前执行的SQL语句：" . $sql;
        return $this->db_link->query($sql)->fetch_array();
    }

    
}