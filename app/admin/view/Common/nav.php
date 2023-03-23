<style>
    .nav_li {
        color: #666;
        font-weight: bold;
    }

    .nav_li a:hover {
        color: #fff;
    }

    .nav_li li {
        text-align: center;
        border-radius: 5px;
    }

    .nav_li_hover {
        color: #0d6efd;
        background-color: #eee;
    }

    .nav_li li:hover {
        background-color: #eee;
        color: #0d6efd;
    }

</style>
<div style="height:20px;"></div>
<div>
    <ul style="        margin: 0px;
        padding: 0px;">
        <?php foreach ($menu_list as $item) {
            $classStr = (str_replace('_', '', $item['href']) == str_replace('_', '', $href)) ? 'nav_li_hover' : $href;
            ?>
            <a class="nav_li {$item['href']} {$classStr} "
               href="{:url($item['href'])}">
                <li style="height:40px;line-height: 40px;">
                    <img style="width:16px;height:16px;" src="/static/images/icons/{$item['icon']??$item['title']}.png">
                    <?php echo $item['title']; ?>
                </li>
            </a>
        <?php } ?>
    </ul>
</div>
