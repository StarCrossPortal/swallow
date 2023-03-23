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
    <div class="col-11 tuchu" style="border-radius:5px;">
        <div class="row">
            <div class="row">
                <div class="col-4">
                    <h6 style="color:#ccc;">泄露总数</h6>
                    <h4>{$totalNum}</h4>
                </div>

                <div class="col-8">
                    <div style="height:20px;"></div>
                    <div class="btn-group me-2" role="group" aria-label="First group" style="float:right;">
                        <button type="button" class="btn btn-outline-secondary">1</button>
                        <button type="button" class="btn btn-outline-secondary">2</button>
                        <button type="button" class="btn btn-outline-secondary">3</button>
                        <button type="button" class="btn btn-outline-secondary">4</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:20px;"></div>
        <div class="row">
            <div class="accordion" id="accordionExample">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">搜索词</th>
                        <th scope="col">文件名</th>
                        <th scope="col">标签</th>
                        <th scope="col">内容</th>
                        <th scope="col">发现时间</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mainList as $item) { ?>
                        <tr>
                            <td>{$item['search_keyword']}</td>
                            <td>

                                <div class="box" style="max-width: 260px;"><?php echo basename($item['file_name']) ?></div>


                            </td>

                            <td>
                                <?php foreach ($item['tags'] as $tag) { ?>
                                    <span class="badge bg-secondary">{$tag}</span>
                                <?php } ?>
                            </td>
                            <td>

                                <textarea style="width: 400px;" class="form-control" disabled>{$item['leak_content']}</textarea>
                            </td>
                            <td>{$item['create_time']}</td>
                            <td>
                                <a class="btn btn-sm btn-light"  target="_blank" href="{$item['url']}">查看</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

