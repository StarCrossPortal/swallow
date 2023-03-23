{include file='public/head' /}

<style>
    a {
        text-decoration: none;
    }

    li {
        list-style: none;
    }
    .box {
        /*强制文本在一行内显示*/
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 600px;
    }
</style>
<div class="row">
    <div class="col-1 ">
        {include file='Common/nav' /}
    </div>
    <div class="col-11 tuchu" style="border-radius:5px;">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" style="border: 1px solid #eee; padding:20px;border-radius:10px;"
                 id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php foreach ($mailList as $key => $item) { ?>
                    <a class="nav-link <?php echo ($key == 0) ? 'active' : '' ?>" id="v-pills-{$key}-tab"
                       data-bs-toggle="pill" href="#v-pills-{$key}"
                       role="tab" aria-controls="v-pills-{$key}" aria-selected="true">{$item['mail']}</a>
                <?php } ?>
            </div>
            <div class="tab-content" id="v-pills-tabContent"
                 style="border: 1px solid #eee; padding:20px;border-radius:10px;">
                <?php foreach ($mailList as $key => $item) { ?>
                    <div class="tab-pane fade <?php echo ($key == 0) ? 'show active' : '' ?>" id="v-pills-{$key}"
                         role="tabpanel"
                         aria-labelledby="v-pills-{$key}-tab">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>来源</th>
                                <th>时间</th>
                            </tr>
                            </thead>
                            <?php foreach ($item['lists'] as $urlInfo) { ?>
                                <tr>
                                    <td class="box"><a href="{$urlInfo['url']}" target="_blank">{$urlInfo['url']}</a></td>
                                    <td>{$urlInfo['create_time']}</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</div>