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

$info['Primary'] = json_decode($info['Primary'] ?? '[]', true);
?>
<div class="row">
    <div class="col-1 ">
        {include file='Common/nav' /}
    </div>
    <div class="col-11 tuchu" style="border-radius: 5px;padding: 20px;">
        <h3 style="text-align: center; margin: 20px;"><span>{$info['Category']}</span></h3>
        <?php

        foreach ($info as $k => $v) { ?>
            <div class="row" style="margin:10px;">
                <div class="col-1" style="color:#ccc;font-weight:bold;"><span style="float:right;">{$k}</span></div>
                <div class="col-11"><?php
                    if (is_array($v)) {
                        echo '<table class="table">';
                        foreach ($v as $key => $val) {
                            $key = htmlspecialchars($key);
                            $val = htmlspecialchars($val);
                            if ($key == 'Snippet') $val = '<textarea class="form-control" rows="5" disabled style="padding-left:0;border: none;background-color:#fafafa;">' . $val . '</textarea>';
                            echo "<tr><td style='color:#ccc;font-weight:bold;width:90px;'>" . $key . "</td><td>" . $val . "</td></tr>";
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
            <a class="btn btn-outline-primary" href="{:url('Scan/detail',['id'=>$preId])}">上一个</a>&nbsp;&nbsp;&nbsp;
        <?php } ?>
        <?php if ($nextId) { ?>
            <a class="btn btn-outline-info" href="{:url('Scan/detail',['id'=>$nextId])}">下一个</a>&nbsp;&nbsp;&nbsp;
        <?php } ?>
        <a class="btn btn-outline-secondary" href="{:url('Scan/report')}">返回</a>
    </div>

</div>