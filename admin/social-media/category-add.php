<?php
require '../../connect.php';
require _DIR_('library/session/session');

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_SESSION['user'])) exit("No direct script access allowed!");
    if($data_user['level'] !== 'Admin') exit("No direct script access allowed!");
?>
<form method="POST">
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
    <input type="hidden" id="web_token" name="web_token" value="<?= base64_encode('social') ?>">
    <div class="form-group">
        <label>Code</label>
        <input type="text" class="form-control" name="category_code">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="category_name">
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-6">
            <button type="button" name="reset" class="btn btn-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
        <div class="form-group col-6">
            <button type="submit" name="category_add" class="btn btn-primary btn-block"> ADD </button>
        </div>
    </div>
</form>
<?php
} else {
    exit("No direct script access allowed!");
}
?>