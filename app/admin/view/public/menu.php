<?php
$indexMenuArr = ['index/index'];
$workMenuArr = ['user_scenario/index'];
$storeMenuArr = ['user_scenario/scenario_store'];
$nodeMenuArr = ['node/index'];
$MenuArr = [
    'index/index' => $indexMenuArr,
    'user_scenario/index' => $workMenuArr,
    'user_scenario/scenario_store' => $storeMenuArr,
    'node/index' => $nodeMenuArr,
];


$activeHref = '';
foreach ($MenuArr as $key=>$val) {
    if (in_array($href, $val)) {
        $activeHref = $key;
    }
}

//var_dump($href,$activeHref);die;
?>
<style>
    .bg-custom-menu {
        --bs-bg-opacity: 1;
        background-color: #0d6efd;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: #fff;
    }

    .radius {
        width: 40px;
        height: 40px;
        border: 1px solid white;
        border-radius: 100px;
        overflow: hidden;
    }

    .radius img {
        width: 100%;
        height: 100%;
    }

    .nav-item {
        padding: 0px 5px 0px 5px;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
    }

    .nav-item a:hover {
        background-color: #fff;
        color: #6a88f7;
        border-radius: 8px;
    }

    .menu_active {
        background-color: #fff;
        color: #6a88f7;
        border-radius: 8px;
    }

    .menu_not_active {
        color: #fff;
    }


</style>
<nav class="navbar navbar-expand-lg bg-custom-menu" aria-label="Tenth navbar example">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/static/images/logo.png" style="max-height:35px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample08">
            <ul class="navbar-nav me-auto navbar-dark">

            </ul>

            <div class="text-end">
                <ul class="nav navbar-nav navbar-right hidden-sm">
                    <li class="nav-item dropdown ">
                        <a href="#" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <div class="radius">
                                <img class="img-circle image-responsive" style="max-width:40px"
                                     src="{$userInfo['headimgurl']}" alt="头像"/>
                            </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown08">
<!--                            <li>-->
<!--                                <a class="dropdown-item" href="{:url('auth/user_info')}">-->
<!--                                    个人资料-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a class="dropdown-item" href="{:url('auth/user_password')}">-->
<!--                                    修改密码-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a class="dropdown-item" href="{:url('login/logout')}">-->
<!--                                    退出登录-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>