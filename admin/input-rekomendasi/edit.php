<?php
require '../../connect.php';
require _DIR_('library/session/admin');

require _DIR_('library/shennboku.app/admin-input-rekomendasi');
$code = isset($_GET['s']) ? filter($_GET['s']) : '';

$search = $call->query("SELECT * FROM rekomendasi WHERE no_id = '$code'");
if($search->num_rows == 0) { $_SESSION['result'] = ['type' => false,'message' => 'QnA not found2.']; exit(redirect(0,base_url('admin/input-rekomendasi/'))); }
$data = $search->fetch_assoc();

require _DIR_('library/layout/header.admin');
?>
<div class="row">
    <div class="col-12">
        <div class="card overflow-hidden">
            <div class="card-header">
                <h4 class="card-title">Edit Rekomendasi</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                    <input type="hidden" id="web_token" name="web_token" value="<?= $code ?>">
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" class="form-control" name="editfaq_quest" value="<?= $data['nomor'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea style="width:100%;" name="editfaq_ans"><?= $data['name'] ?></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" <?= onclick_href(base_url('admin/input-rekomendasi/')) ?> class="btn btn-warning waves-effect waves-light">Back</button>
                        <button type="submit" name="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        <button type="submit" name="editrekomendasi" class="btn btn-primary waves-effect waves-light">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>