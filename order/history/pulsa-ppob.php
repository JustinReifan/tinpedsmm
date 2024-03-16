<?php 
require '../../connect.php';
require _DIR_('library/session/user');
require _DIR_('library/layout/header.user');
?>
<section id="basic-datatable">
    <style type="text/css">input[type='text']{font-size:12px}table.datatable td{font-size: 12px;vertical-align:middle}</style>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?= currency($call->query("SELECT id FROM trx_ppob WHERE status = 'error' AND user = '".$data_user['username']."'")->num_rows) ?></h2>
                        <p>Error</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-flag text-danger font-medium-5"></i>
                        </div>
                    </div>
                </div>
                </br>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?= currency($call->query("SELECT id FROM trx_ppob WHERE status = 'waiting' AND user = '".$data_user['username']."'")->num_rows) ?></h2>
                        <p>Waiting</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-loader text-warning font-medium-5"></i>
                        </div>
                    </div>
                </div>
                </br>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                  <div>
                      <h2 class="text-bold-700 mb-0"><?= currency($call->query("SELECT id FROM trx_ppob WHERE status = 'success' AND user = '".$data_user['username']."'")->num_rows) ?></h2>
                      <p>Success</p>
                  </div>
                  <div class="avatar bg-rgba-success p-50 m-0">
                      <div class="avatar-content">
                            <i class="feather icon-package text-success font-medium-5"></i>
                      </div>
                  </div>
                </div>
                </br>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pulsa PPOB</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration datatable" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Target</th>
                                    <th>Price</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="5" class="text-center">Loading data from server...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? require _DIR_('library/layout/modal'); require _DIR_('library/layout/footer.user'); ?>
<?= datatable(['url' => ajaxlib('table/transaction?__s=1'),'sort' => 0,'type' => 'desc']) ?>