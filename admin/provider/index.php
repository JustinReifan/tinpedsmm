<?php 
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/shennboku.app/admin-provider');
require _DIR_('library/layout/header.admin');
?>
<section id="basic-datatable">
    <style type="text/css">input[type='text']{font-size:12px}table.datatable td{font-size: 12px;vertical-align:middle}</style>
    
     <div class="row">
 
        <div class="col-6 col-md-3">
       <a href="/library/cron/get/get-rotasipedia.php" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light"  target="_blank" style="background-color: #0088CC;">GET SOCMED ROTASI</a> 
        </div>
        
        <div class="col-6 col-md-3">
       <a href="/library/cron/get/get-medanpedia.php" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light"  target="_blank" style="background-color: #0088CC;">GET SOCMED MEDAN</a> 
        </div>
        
        <div class="col-6 col-md-3">
       <a href="/library/cron/get/LOLLIPOP.php" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light"  target="_blank" style="background-color: #0088CC;">GET SOCMED LOLLIPOP</a> 
        </div>
        
        <div class="col-6 col-md-3">
       <a href="/library/cron/get/vip.php" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light"  target="_blank" style="background-color: #0088CC;">GET GAME VIP</a> 
        </div>
    
        <div class="col-6 col-md-3">
               <a href="/library/cron/get/digiflazz.php" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light" style="background-color: #0088CC;">PPOB Digi</a>
        </div>

        
        <div class="col-6 col-md-3">

        <a href="/library/cron/get/delete" class="btn btn-relief-primary btn-block mb-1 waves-effect waves-light " style="background-color: #ed302f;">DELETE ALL</a>
        </div>
       
    </div>
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">API Integrations</h4>
                </div>
                
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration datatable" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Balance</th>
                                    <th>Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="3" class="text-center">Loading data from server...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? require _DIR_('library/layout/modal'); require _DIR_('library/layout/footer.user'); ?>
<?= datatable(['url' => base_url('admin/provider/ajax-table'),'sort' => 0,'type' => 'asc']) ?>