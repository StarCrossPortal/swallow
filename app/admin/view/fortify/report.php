{include file='public/head' /}
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
    <div class="col-11 tuchu" style="border-radius: 5px;">
        <div class="row">
            <?php foreach ($countList as $item) { ?>
                <div class="col-3">
                    <div style="height: 155px;margin-bottom:20px;border-radius: 10px;padding:10px;border: 1px solid #eee;">
                        <p style="color: #ccc;font-weight:bold;">{$item['name']}</p>
                        <h4>{$item['num']}</h4>
                        <?php foreach ($item['lists'] as $tag => $num) { ?>
                            <span style="color: #ccc;">{$tag}</span> <span>{$num}</span>&nbsp;
                        <?php } ?>
                    </div>

                </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a type="button"
                       class="btn btn-outline-primary <?php echo isset($param['is_repair']) ? '' : 'active' ?> "
                       href="<?php echo str_replace('is_repair=', '', $_SERVER['REQUEST_URI']) ?>">全部</a>
                    <a type="button"
                       class="btn btn-outline-primary  <?php echo isset($param['is_repair']) && $param['is_repair'] == 0 ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&is_repair=0">未修复</a>
                    <a type="button"
                       class="btn btn-outline-primary  <?php echo isset($param['is_repair']) && $param['is_repair'] ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&is_repair=1">已修复</a>
                </div>
                &nbsp;
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a type="button"
                       class="btn btn-outline-primary  <?php echo isset($param['Folder']) ? '' : 'active' ?> "
                       href="<?php echo str_replace('Folder=', '', $_SERVER['REQUEST_URI']) ?>">全部</a>
                    <a type="button"
                       class="btn btn-outline-primary <?php echo isset($param['Folder']) && $param['Folder'] == 'Critical' ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&Folder=Critical">严重</a>
                    <a type="button"
                       class="btn btn-outline-primary <?php echo isset($param['Folder']) && $param['Folder'] == 'High' ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&Folder=High">高危</a>
                    <a type="button"
                       class="btn btn-outline-primary <?php echo isset($param['Folder']) && $param['Folder'] == 'Medium' ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&Folder=Medium">中危</a>
                    <a type="button"
                       class="btn btn-outline-primary <?php echo isset($param['Folder']) && $param['Folder'] == 'Low' ? 'active' : '' ?>"
                       href="{$_SERVER['REQUEST_URI']}&Folder=Low">低危</a>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div style="margin-top:20px;">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="color:#aaa;">id</th>
                            <th style="color:#aaa;">缺陷文件</th>
                            <th style="color:#aaa;">漏洞类型</th>
                            <th style="color:#aaa;">所属仓库</th>
                            <th style="color:#aaa;">漏洞等级</th>
                            <th style="color:#aaa;">发现时间</th>
                            <th style="color:#aaa;">状态</th>
                            <th style="color:#aaa;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bugList['list'] as $item) { ?>
                            <tr>
                                <td>{$item['id']}</td>
                                <td>{$item['primary_info']['FileName']}</td>
                                <td>{$item['Category']}</td>
                                <td><a href="{$item['git_addr']}" title="{$item['git_addr']}" target="_blank">{:parse_url($item['git_addr'],PHP_URL_PATH)}</a></td>
                                <td>{$item['Folder']}</td>
                                <td>{$item['create_time']}</td>
                                <td>{$item['is_repair']}</td>
                                <td><a class="btn btn-sm btn-light" href="{:URL('detail',['id'=>$item['id']])}" aria-disabled="true">查看详情</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {include file='public/fenye' /}
            </div>
        </div>
    </div>
</div>