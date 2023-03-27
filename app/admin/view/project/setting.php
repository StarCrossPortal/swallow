{include file='public/head' /}
<?php

$qtConfDemo = '{ 
    "mysql_db_name": "root",
    "mysql_host": "xxxxxxx",
    "mysql_password": "dolphin123!",
    "mysql_username": "root",
    "fortify_path": "xxxx",
    "mf_token": "xxx"
}';

$projectConf['QT_CONF'] = array_merge(json_decode($qtConfDemo, true), json_decode($projectConf['QT_CONF'] ?? '[]', true));
$projectConf['QT_CONF'] = json_encode($projectConf['QT_CONF']);
$projectConf['QT_CONF'] = str_replace(",", ",\n", $projectConf['QT_CONF']);
$projectConf['QT_CONF'] = str_replace("{", "{\n", $projectConf['QT_CONF']);
$projectConf['QT_CONF'] = str_replace("}", "\n}", $projectConf['QT_CONF']);
?>
<style>
    a {
        text-decoration: none;
    }

    li {
        list-style: none;
    }
</style>
<div class="row">
    <div class="col-1 ">
        {include file='Common/nav' /}
    </div>
    <div class="col-11 tuchu" style="border-radius:5px;">
        <div style="height:24px;"></div>
        <div class="row">
            <div class="col-5">
                <div style="border-radius:10px;border: 1px solid #ccc;padding:10px;">
                    <div style="padding:10px;">
                        <span style="color:#666;font-weight: bold;font-size: 16px;">蜻蜓引擎配置</span>
                    </div>
                    <div>
                        <form method="post" action="{:URL('project/update_project_conf')}">
                            <div style="margin-bottom: 10px;">
                                <span><input class="form-control" type="text" name="QT_TOKEN"
                                             placeholder="请填写蜻蜓Token"
                                             value="{$projectConf['QT_TOKEN'] ?? ''}"></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span>
                                    <input class="form-control" type="text" name="QT_ID" placeholder="请填写工作流ID"
                                           value="{$projectConf['QT_ID'] ?? ''}">
                                </span>
                            </div>
                            <div style="margin-bottom: 10px;">
                            <span>
                                <textarea rows="12" class="form-control" name="QT_CONF"
                                          placeholder='全局变量参数 {"xxx":"xxx"}'>{$projectConf['QT_CONF'] ?? $qtConfDemo}</textarea>
                            </span>
                            </div>
                            <?php if (!empty($paramRet)) { ?>
                                <div style="margin-bottom: 10px;">
                                    <span style="color:#ccc;">引擎配置保存到蜻蜓结果</span>
                                    <textarea style="color:#aaa;" rows="2" class="form-control" disabled>{$paramRet ?? ''}</textarea>
                                </div>
                            <?php } ?>
                            <div style="margin-bottom: 10px;">

                                <span style="color:#666;font-weight: bold;font-size: 16px;">周期扫描设置</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <div class="input-group">
                                    <span class="input-group-text">首次扫描</span>
                                    <input class="form-control" type="datetime-local" step="1" name="cycle_start_time"
                                           placeholder="首次运行时间"
                                           value="{$projectConf['cycle_start_time'] ?? date('Y-m-d H:i:s')}">
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <div class="input-group">
                                    <input type="text" name="time_value" class="form-control"
                                           value="{$projectConf['time_value'] ?? 0}"/>
                                    <select class="form-control" name="schedule">
                                        <?php $projectConf['schedule'] = $projectConf['schedule'] ?? 3600; ?>
                                        <option value="1"
                                                <?php echo ($projectConf['schedule'] == 1) ? 'selected' : '' ?>秒
                                        </option>
                                        <option value="60" <?php echo ($projectConf['schedule'] == 60) ? 'selected' : '' ?>>
                                            分
                                        </option>
                                        <option value="3600" <?php echo ($projectConf['schedule'] == 3600) ? 'selected' : '' ?>>
                                            小时
                                        </option>
                                        <option value="86400" <?php echo ($projectConf['schedule'] == 86400) ? 'selected' : '' ?>>
                                            天
                                        </option>
                                        <option value="604800" <?php echo ($projectConf['schedule'] == 604800) ? 'selected' : '' ?>>
                                            周
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <?php if (!empty($paramRet)) { ?>
                                <div style="margin-bottom: 10px;">
                                    <span style="color:#ccc;">周期扫描设置保存到蜻蜓结果</span>
                                    <textarea style="color:#aaa;" rows="2" class="form-control" disabled>{$ruleRet ?? ''}</textarea>
                                </div>
                            <?php } ?>
                            <div style="margin-bottom: 10px;">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-outline-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div style="border-radius:10px;border: 1px solid #ccc;padding:10px;">
                    <div style="color:#999;">
                        <h5>配置说明</h5>
                        <p>1. 项目不集成fortify,需要你将已有的fortify路径配置放进去</p>
                        <p>2. SCA工具使用的是墨菲,需要你把token填进去 <a target="_blank" href="https://www.murphysec.com/usr/token">点此</a> 生成</p>
                        <p>3. 底层使用蜻蜓开发,需要你添加节点,并克隆对应的工作流 <a target="_blank" href="http://qingting.starcross.cn/scenario/detail?id=2084">点此</a>添加</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='project/add_git' /}