<?php
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/shennboku.app/setting-wapisender');
require _DIR_('library/layout/header.admin');


?>
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Setting Wapisender</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                    <div class="form-group">
                        <label>Device</label>
                        <input type="text" class="form-control" name="devices" value="<?= conf('wapisender',1) ?>" placeholder="device">
                         <label>Key</label>
                        <input type="text" class="form-control" name="keys" value="<?= conf('wapisender',2) ?>" placeholder="key">
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" name="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        <button type="submit" name="simpanwa" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>