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
        <div style="height:24px;"></div>
        <div class="row">
            <div class="col-5">
                <div style="border-radius:10px;border: 1px solid #ccc;padding:10px;">
                    <div style="padding:10px;">
                        <span style="color:#666;font-weight: bold;font-size: 16px;">工具配置</span>
                    </div>
                    <div>
                        <form method="post" action="{:URL('project/update_project_conf')}">
                            <div class="mb-3">
                                <input type="text" name="fortify_path" class="form-control"   placeholder="/opt/fortify/ (fortify 存放路径)">
                            </div>
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
                        <p>2. SCA工具使用的是墨菲,需要你把token填进去 <a target="_blank"
                                                                         href="https://www.murphysec.com/usr/token">点此</a>
                            生成</p>
                        <p>3. 底层使用蜻蜓开发,需要你添加节点,并克隆对应的工作流 <a target="_blank"
                                                                                    href="http://qingting.starcross.cn/scenario/detail?id=2084">点此</a>
                            添加</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='project/add_git' /}