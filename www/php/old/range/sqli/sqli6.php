<?php

if (isset($_GET['id'])) {
    @$id = $_GET['id'];

    $db_link = new mysqli('mysql', 'root', 'root', 'lnmp');
    if ($db_link->connect_error) {
        echo "数据库连接出错：" . $db_link->connect_error;
    }

    @$sql = 'select * from user where id = \'' . $id . '\';';
    echo "当前执行的 SQL 语句：" . $sql . "\n";
    $result = $db_link->query($sql);
    $rows = $result->fetch_array();
    if ($rows) {
        echo 'this is txt.';
    }else {
        echo "<br />";
        // echo mysqli_error($db_link);
        // print_r(mysql_error($db_link));
    }
    mysqli_close($db_link);
} else {
    echo "please input id";
}
