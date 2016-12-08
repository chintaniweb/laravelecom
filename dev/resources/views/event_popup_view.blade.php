<section>
    <div class="modal-header">
        <div class="logo-box">
            <a href="/" class="logo">
                <img src="<?php echo url('/') . '/resources/assets/front_themes/boces/' ?>images/logo.jpg" alt="BOCES">
            </a>
        </div>
    </div>
    <div class="modal-body">
        <p><strong><?php echo $data[0]->category_name; ?></strong><br>
            <?php echo date('l,F d,Y', strtotime($data['0']->event_start)); ?></p>
        
        <p><strong><?php echo $data[0]->headline ?></strong><br>
            <?php echo $data[0]->full_event_description; ?></p>

        <p><strong>Site:</strong> <?php echo $data[0]->location_name; ?><br>
            <strong>Start Time:</strong> <?php echo $data[0]->start_time; ?></p>

        <p>Note: times are based on Eastern time zone</p>
    </div>
    <div class="modal-footer">
        <a href="javascript:window.close()"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>  
    </div>
</section>
<script> 
    $('.modal').on('hidden.bs.modal', function (e)
    {
        $(this).removeData();
    });
</script>