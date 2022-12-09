<?php

class TestController extends Base_UC {

    public function testAction() {

        $input = $_GET['token'];
        $input = str_replace(array("\n", "\0"), '', $input);

        $recoveryId = strtoupper(md5(uniqid('', true)));
        $recoveryId = substr(chunk_split($recoveryId, 8, '-'), -7, 18);

        if (isset($input) && $input === $recoveryId) {
            header("location: flag");
        } else {
            header("location: login");
        }
        echo 'input: ' . $input . "\n";
        echo 'recoveryId: ' . $recoveryId;
    }

    public function loginAction() {
        echo 'login';
    }

    public function flagAction() {
        echo 'flag{fwef23122421rfrfw}';
    }
}