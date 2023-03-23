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
    <div class="col-11 tuchu" style="border-radius: 5px; ">
        <div class="row" style="border-radius: 10px; margin-bottom: 20px;">
            <div class="col-12">
                <h5 class="home_title">分类</h5>
            </div>
            <?php foreach ($categoryList as $item) { ?>
                <div class="col-2" >
                    <div style="border-radius: 10px;padding:10px;margin-bottom:20px;border: 1px solid #eee;height: 155px; ">
                        <p>{$item['name']}</p>
                        <div class="category_list" style="height:90px; ">
                        <?php foreach ($item['lists'] as $name=>$val) { ?>
                            <span class="badge bg-primary" style="margin-bottom:5px;">{$name}&nbsp;
                                <span class="badge bg-light text-dark" style="font-size:5px;margin: 0px;">{$val}</span>
                            </span>
                        <?php } ?>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>

        <div class="row" style="margin-bottom: 20px;">
            <?php foreach ($otherList as $item) { ?>
                <div class="col-3">
                    <div style="height: 300px;border-radius: 10px;margin-bottom: 20px;padding:10px; border: 1px solid #eee; ">
                        <p class="home_title" >{$item['title']}</p>
                        <div style="height:220px; overflow:auto;overflow-y:scroll; overflow-y:hidden; ">
                        <ul >
                            <?php foreach ($item['lists'] as $name => $num) { ?>
                                <li class="home_li" >{$name}&nbsp;<span style="float:right;">{$num}</span></li>
                            <?php } ?>
                        </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    .home_title{
        height:40px;line-height:40px; font-weight: bold;
        font-size:15px;
    }
    .home_li{
        color: #666;
        margin: 0px;
        padding: 0px;
        font-size:14px;
    }
    .category_list {
        overflow-y:hidden;
    }
    .category_list:hover{
        overflow:auto;
    }
</style>