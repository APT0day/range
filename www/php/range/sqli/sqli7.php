<?php

if (isset($_GET['id'])) {
    @$id = $_GET['id'];

    $id = preg_replace('/--/', '', $id);
    $id = preg_replace('/#/', '', $id);
    
    $db_link = new mysqli('mysql', 'root', 'root', 'lnmp');
    if ($db_link->connect_error) {
        echo '数据库连接出错：' . $db_link->connect_error;
    }

    @$sql = 'select * from user where id = \'' . $id . '\';';
    echo'当前执行的 SQL 语句：' . $sql . "\n";
    $result = $db_link->query($sql);
    $rows = $result->fetch_array();
    if ($rows) {
        echo '<table align="center" width="300" cellpadding="0" cellspacing="0" border="1">';
        echo '<tr align="center" height="30">';
        echo '<th>Username</th>';
        echo '<th>Password</th>';
        echo '</tr>';
        echo '<tr align="center" height="30">';
        echo '<td>' . $rows['user'] . '</td>';
        echo '<td>' . $rows['pwd'] . '</td>';
        echo '</tr>';
        echo '</table>';
    }else {
        // echo mysqli_error($db_link);
        print_r(mysqli_error($db_link));
    }
    mysqli_close($db_link);
} else {
    echo 'please input id';
}
