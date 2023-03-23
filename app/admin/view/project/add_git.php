<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="<?php echo url('project/_add_domain'); ?>">
                    <div class="mb-3">
                        <label class="form-label">Git地址</label>
                        <textarea class="form-control" name="git_addr" placeholder="每行一个Git地址,例如: https://github.com/78778443/QingScan.git" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">添加</button>
                </form>
            </div>
        </div>
    </div>
</div>