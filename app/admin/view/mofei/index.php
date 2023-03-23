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
            <div class="col-12">
                <div style="margin-top:20px;">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="color:#aaa;">id</th>
                            <th style="color:#aaa;">组件名称</th>
                            <th style="color:#aaa;">组件版本</th>
                            <th style="color:#aaa;">漏洞等级</th>
                            <th style="color:#aaa;">许可证</th>
                            <th style="color:#aaa;">依赖语言</th>
                            <th style="color:#aaa;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bugList['list'] as $item) { ?>
                            <tr>
                                <td>{$item['id']}</td>
                                <td>{$item['comp_name']}</td>
                                <td>{$item['show_level']}</td>
                                <td>{$item['version']}</td>
                                <td>{$item['license']}</td>
                                <td>{$item['language']}</td>
                                <td><a class="btn btn-sm btn-light" href="{:URL('comp_detail',['id'=>$item['id']])}" aria-disabled="true">查看详情</a></td>
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