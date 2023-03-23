<?php

$formInfo = isset($formInfo) ? $formInfo : [];

$formList = $formInfo['list'] ?? [];
?>


<form method="<?php echo $formInfo['method']; ?>" action="<?php echo $formInfo['action']; ?>"
      enctype="multipart/form-data">
    <div class="modal-body">
        <?php foreach ($formList as $value) { ?>
            <?php if (in_array($value['type'], ['hidden'])) { ?>
                <input type="hidden" name="{$value['name']}" class="form-control" value="{$value['value']}"
                       placeholder="{$value['placeholder']??''}"
                    <?php echo $value['required'] ? 'required' : ''; ?>>
            <?php } ?>
            <?php if (in_array($value['type'], ['text', 'url'])) { ?>
                <div class="mb-3">
                    <label class="form-label">{$value['label']}</label>
                    <input type="{$value['type']}" name="{$value['name']}" class="form-control"
                           value="{$value['value']}"
                           placeholder="{$value['placeholder']}"
                        <?php echo $value['required'] ? 'required' : ''; ?>>
                </div>
            <?php } ?>
            <?php if (in_array($value['type'], ['textarea'])) { ?>
                <div class="mb-3">
                    <label class="form-label">{$value['label']}</label>
                    <textarea name="{$value['name']}" class="form-control" rows="{$value['rows']}"
                              placeholder="{$value['placeholder']}" <?php echo $value['required'] ? 'required' : ''; ?>>{$value['value']}</textarea>
                </div>
            <?php } ?>
            <?php if (in_array($value['type'], ['select'])) { ?>
                <div class="mb-3">
                    <label class="form-label">{$value['label']}</label>
                    <select name="{$value['name']}" class="form-select">
                        <?php foreach ($value['options'] as $k => $val) { ?>
                            <option value="{$k}" {eq name="value.value" value="k" }selected{/eq}>{$val}</option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <?php if (in_array($value['type'], ['checkbox'])) {

                ?>
                <div class="mb-3">
                    <label class="form-label">{$value['label']}</label><br>
                    <?php foreach ($value['options'] as $k => $val) { ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="{$value['name']}" value="{$k}"
                            <?php echo in_array($k, $value['values']) ? 'checked="checked"' : '' ?>
                            <label class="form-check-label">{$val}</label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if (in_array($value['type'], ['file'])) {
                ?>
                <div class="mb-3">
                    <label for="formFile" class="form-label">{$value['label']}</label>
                    <input class="form-control" name="target_file" type="file" id="formFile">
                </div>
            <?php } ?>
            <?php if (in_array($value['type'], ['date'])) {
                ?>
                <div class="mb-3">
                    <label class="form-label">{$value['label']}</label>
                    <input type="datetime-local" name="{$value['name']}" class="form-control" value="{$value['value']}"
                           placeholder="{$value['placeholder']}"
                        <?php echo $value['required'] ? 'required' : ''; ?>>
                </div>
            <?php } ?>

        <?php } ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-info">提交</button>
    </div>
</form>
