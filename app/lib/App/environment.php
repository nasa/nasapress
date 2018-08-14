<?php

namespace App;

function environment() {

    $svrname = preg_replace('#^https?://#', '', home_url());
    // todo-config
        switch($svrname) {
            case 'www1.grc.nasa.gov':
                return 'production';
            case 'ewwwd1.grc.nasa.gov/wordpress':
                return 'test';
            default:
                return 'development';
    }
}
?>