<?php 
require '../connect.php';
require _DIR_('library/session/session');
require _DIR_('library/layout/header.user');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chat Admin Jika Ada Kendala</h4>
            </div>
            <div class="card-body">
                <?= base64_decode(conf('pages',2)) ?>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>