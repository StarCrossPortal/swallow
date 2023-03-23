{include file='public/head' /}
<style>
    a {
        text-decoration: none;
    }

    li {
        list-style: none;
    }
</style>
<?php

$info['license'] = json_decode($info['license'], true);
//$info['vuln_path'] = json_decode($info['vuln_path'], true);
?>
<div class="row">
    <div class="col-1 ">
        {include file='Common/nav' /}
    </div>
    <div class="col-11 tuchu" style="border-radius: 5px;padding: 20px;">
        <h3 style="text-align: center; margin: 20px;"><span>{$info['comp_name']}</span></h3>
        <?php

        foreach ($info as $k => $v) { ?>
            <div class="row" style="margin:10px;">
                <div class="col-1" style="color:#ccc;font-weight:bold;"><span style="float:right;">{$k}</span></div>
                <div class="col-11"><?php
                    if (is_array($v)) {
                        echo '<table class="table">';
                        foreach ($v as $key => $val) {
                            if (is_array($val)) {
                                echo '<tr> <td><table class="table">';
                                foreach ($val as $subkey => $subValue) {
                                    $subValue = is_array($subValue) ? json_encode($subValue) : $subValue;
                                    $subkey = htmlspecialchars($subkey);
                                    $subValue = htmlspecialchars($subValue);
                                     echo "<tr> <td>" . $subValue . "</td></tr>";
                                }
                                echo '</table></td></tr>';
                            } else {
                                $key = htmlspecialchars($key);
                                $val = htmlspecialchars($val);
                                echo "<tr><td  style='color:#ccc;font-weight:bold;width:60px;'>".$key."</td><td>" . $val . "</td></tr>";
                            }

                        }
                        echo '</table>';
                    } else {
                        echo $v;
                    }
                    ?></div>
            </div>
        <?php } ?>

    </div>
    <div class="col-1 "></div>

    <div class="col-11 tuchu" style="border-radius: 5px;padding: 20px;text-align:center;">
        <?php if ($preId) { ?>
            <a class="btn btn-outline-primary" href="{:url('comp_detail',['id'=>$preId])}">上一个</a>&nbsp;&nbsp;&nbsp;
        <?php } ?>
        <?php if ($nextId) { ?>
            <a class="btn btn-outline-info" href="{:url('comp_detail',['id'=>$nextId])}">下一个</a>&nbsp;&nbsp;&nbsp;
        <?php } ?>
        <a class="btn btn-outline-secondary" href="{:url('index')}">返回</a>
    </div>

</div>