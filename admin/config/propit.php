<?php
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/shennboku.app/setting_propit');
require _DIR_('library/layout/header.admin');
?>
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Mengatur Keuntungan</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                    <label>Tipe *</label>
                    <div class="form-group">
                        <label>PPOB Basic</label>
                        <input type="text" class="form-control" name="ppobb" value="<?= conf('profit',9) ?>" placeholder="basic">
                         <label>PPOB Premium</label>
                        <input type="text" class="form-control" name="ppobp" value="<?= conf('profit',10) ?>" placeholder="premium">
                    </div>
                    
                    <label>Tipe *</label>
                    <div class="form-group">
                        <label>SOSMED Basic</label>
                        <input type="text" class="form-control" name="sosmedb" value="<?= conf('profit',3) ?>" placeholder="basic">
                        <label>SOSMED Premium</label>
                        <input type="text" class="form-control" name="sosmedp" value="<?= conf('profit',4) ?>" placeholder="premium">
                    </div>
                    
                    <label>Kurs Dolar & Profit SMMR</label>
                    <div class="form-group">
                        <label>USD > RP</label>
                        <input type="text" class="form-control" name="dolarset" value="<?= conf('profit',5) ?>" placeholder="dolar">
                        <label>Profit SMMRB</label>
                        <input type="text" class="form-control" name="raja1" value="<?= conf('profit',6) ?>" placeholder="basic">
                         <label>Profit SMMRP</label>
                        <input type="text" class="form-control" name="raja2" value="<?= conf('profit',7) ?>" placeholder="premium">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        <button type="submit" name="setprofit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>