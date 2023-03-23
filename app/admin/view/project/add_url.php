<div class="modal fade" id="exampleModal_URL" tabindex="-1" aria-labelledby="exampleModal_URLLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="<?php echo url('project/_add_url'); ?>">
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="url" placeholder="例如: http://www.songboy.site/">
                    </div>
                    <button type="submit" class="btn btn-primary">添加</button>
                </form>
            </div>
        </div>
    </div>
</div>