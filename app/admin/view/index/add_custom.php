<?php


$authList = [];

$placeholder = "192.168.1.1\n192.168.1.0/24\nbaidu.com";
$formInfo =
    [
        'method' => 'post',
        'action' => url('index/_add_batch'),
        'list' => [
            ['label' => 'HOST LIST', 'type' => 'textarea', 'name' => 'hosts', 'value' => '',
                'placeholder' => $placeholder, 'required' => true, 'rows' => 10],
        ]
    ];
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">添加目标</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {include file='public/form' /}
        </div>
    </div>
</div>
