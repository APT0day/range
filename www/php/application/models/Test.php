<?php

class TestModel {
    
    use Base_M;

    public function test($username) {
        $where = ['username' => $username];
        return $this->db_link->table('user')->getOne($where);
    }
}