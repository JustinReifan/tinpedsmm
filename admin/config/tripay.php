<?php
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/rotasipay/admin-config-tripay');
require _DIR_('library/layout/header.admin');
?>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tripay</h4>
            </div>
            <div class="card-body">
                <p>Callback : <code><?= base_url() ?>library/rotasipay/try/tripay-callback.php</code></p>
                <form method="POST">
                    <div class="form-group">
                        <label>Api Key</label>
                        <input type="text" class="form-control" name="tripay_key" value="<?= u('get', 'tripay_key'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Private Key</label>
                        <input type="text" class="form-control" name="tripay_private" value="<?= u('get', 'tripay_private'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Kode Merchant</label>
                        <input type="text" class="form-control" name="tripay_merchant" value="<?= u('get', 'tripay_merchant'); ?>">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        <button type="submit" name="savetripay" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>