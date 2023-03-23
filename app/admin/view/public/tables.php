<table class="table table-sm">
    <thead>
    <tr>
        <?php foreach ($tableInfo['keys'] as $key => $value) { ?>
            <th>{$key}</th>
        <?php } ?>
    </tr>
    </thead>
    <?php foreach ($list as $value) {
        ?>
        <tr>
            <?php foreach ($tableInfo['keys'] as $key => $val) { ?>
                <td><?php
                    if (is_array($val) && ($val['type'] == 'raw')) {
                        echo $val['content'];
                    } elseif (is_array($val) && ($val['type'] == 'select')) { ?>
                        <select class="changCheckStatus form-select" data-id="{$val['id']}"
                                data-action="{$val['action']}">
                            <?php foreach ($val['options'] as $v => $name) { ?>
                                <option value="{$v}" <?php echo $val['value'] == $v ? 'selected' : ''; ?> >
                                    {$name}
                                </option>
                            <?php } ?>
                        </select>
                        <?php
                        //普通input处理
                    } elseif (strtotime($value[$val] ?? date('Y-m-d H:i:s')) > time() - 8640000) {
                        echo getTimeMsg($value[$val] ?? date('Y-m-d H:i:s'));
                    } elseif ($key == '检测目标') {
                        echo getTargetName($value[$val]);
                    } elseif ($key == '用户ID') {
                        echo getNicknameById($value[$val]);
                    } elseif (in_array($val, ['cmd_raw', 'tool_raw']) && is_string($value[$val])) {
                        $aa = is_json($value[$val]) ? var_export(json_decode($value[$val], true)) : $value[$val] ?? $val;
                        $aa = empty($aa) ? '' : $aa;
                        echo "<pre>" . htmlentities($aa) . "</pre>";
                    } elseif (isset($value[$val])) {
                        $aa = is_json($value[$val]) ? var_export(json_decode($value[$val], true)) : $value[$val] ?? $val;
                        $aa = empty($aa) ? '' : $aa;
                        echo htmlentities($aa);
                    }
                    ?></td>
            <?php } ?>
            <td>
                <?php foreach ($tableInfo['optBtns'] as $btnInfo) { ?>
                    <a href="{$btnInfo['href']}" class="btn btn-outline-primary btn-sm">{$btnInfo['name']}</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (empty($list)) { ?>
        <tr>
            <td colspan="{:count($tableInfo['keys'])}"><?php echo $tableInfo['nullNotice'] ?? '暂无数据' ?></td>
        </tr>
    <?php } ?>
</table>