<script type="text/javascript"> 
function modal(name,link,size) {
    $.ajax({
        type: "GET",
        url: link,
        beforeSend: function() {
            $('#SModal-title').html(name);
            $('#SModal-body').html('Loading...');
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        },
        success: function(result) {
            $('#SModal-title').html(name);
            $('#SModal-body').html(result);
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        },
        error: function() {
            $('#SModal-title').html(name);
            $('#SModal-body').html('Failed to get contents...');
            if(size == 'sm' || size == 'small') {
                $('#SModal-size').addClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            } else if(size == 'lg' || size == 'large') {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').addClass('modal-lg');
            } else {
                $('#SModal-size').removeClass('modal-sm');
                $('#SModal-size').removeClass('modal-lg');
            }
        }
    });
    $('#SModal').modal();
}
</script>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="SModal" style="border-radius:7%" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" id="SModal-size">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="SModal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="SModal-body">
            
            </div>
                <div class="d-flex  justify-content-between m-1">
                <button type="button"class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Kembali</button>

                 <a href="https://wa.me/6281246910908?text=Hallo%20Admin" target="_blank" class="btn btn-info text-white" role="button"><i class="fa fa-paper-plane" aria-hidden="true"></i> Complain</a>
            </div>
        </div>
    </div>
</div>