<?php 
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/shennboku.app/admin-service-add');
require _DIR_('library/shennboku.app/admin-service-edit');
require _DIR_('library/shennboku.app/admin-service-delete');
require _DIR_('library/shennboku.app/admin-service-clear');
require _DIR_('library/layout/header.admin');
?>
<section id="basic-datatable">
    <style type="text/css">input[type='text']{font-size:12px}table.datatable td{font-size: 12px;vertical-align:middle}</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Social Media</h4>
                    <div class="dropdown chart-dropdown">
                        <button class="btn btn-sm border-0 dropdown-toggle px-50 waves-effect waves-light" type="button" id="dropdownItem2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Menu
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem2">
                          <a class="dropdown-item" href="javascript:;" <?= onclick_modal('Add Service', base_url('admin/social-media/service-add'), 'lg') ?>>Add Once</a>
                          <a class="dropdown-item" href="javascript:;" <?= onclick_modal('Clear Service', base_url('admin/social-media/service-clear'), 'md') ?>>Clear</a>
                          <a class="dropdown-item" a href="javascript:;" <?= onclick_modal('Clear Service', base_url('library/enivay/ws-service.php'), 'md') ?>>Clear</a>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration datatable" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Category/Service</th>
                                    <th>Price</th>
                                    <th>PID/Provider</th>
                                    <th>Act.</th>
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
<?= datatable(['url' => ajaxlib('table/service?__s=2'),'sort' => 4,'type' => 'asc']) ?>