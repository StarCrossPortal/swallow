<?php
// 应用公共文件


function execLog($cmd){
    echo $cmd.PHP_EOL;
    return exec($cmd);
}