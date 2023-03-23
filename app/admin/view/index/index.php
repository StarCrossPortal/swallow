{include file='public/head' /}
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索"],
    ],
    'btnArr' => [
        [
            'text' => '添加工具',
            'ext' => [
                "href" => url('ability/add'),
                "class" => "btn btn-outline-success",
                "data-bs-toggle" => "modal",
                "data-bs-target" => "#exampleModal",
            ]
        ]
    ]
];
?>
{include file='public/search' /}
<div class="col-md-12 tuchu">
    <div class="row ">
        <div class="col-md-12 ">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>主机</th>
                    <th>开放端口</th>
                    <th>扫描进度</th>
                    <th>扫描时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <?php foreach ($list as $value) { ?>
                    <tr>
                        <td>{$value['id']}</td>
                        <td>{$value['host']}</td>
                        <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                                      disabled></textarea></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </td>

                        <td>{$value['create_time']}</td>
                        <td>
                            <a class="btn btn-outline-info btn-sm">详情</a>
                            <a class="btn btn-outline- btn-sm">删除</a>

                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <input type="hidden" id="to_examine_url" value="<?php echo url('index/add') ?>">
    {include file='index/add_custom' /}
    {include file='public/fenye' /}
</div>
{include file='public/footer' /}
