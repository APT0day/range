<?php
try {
    @$db_link = new \mysqli('localhost:3306', 'root', 'root', 'range');
    if($db_link->connect_errno) {
        echo("连接失败：" . $db_link->connect_errno);
    }
    echo "连接成功";
    $sql = 'select * from user;';
    $result = $db_link->query($sql)->fetch_array();
    var_dump($result);
}catch(Exception $e) {
    echo $e->getMessage();
}