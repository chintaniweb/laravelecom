@extends('layouts.master_front')
@section('content')

<section>
  <div class="inner-content-section">  	
  	<div class="container">
	  <div class="row">        
        <div class="col-sm-12 col-xs-12 content-area">
          <div class="content-area-title"><?php echo $data[0]->title;?></div>
          <div class="content-area-desc">
          	<div class="gallery-slider">
                    <?php foreach ($slide_image_data as $slide_image) { ?>
                    
                        <div class="gallery-slider-item">
                            <figure><img src="<?php echo url('/') . "/resources/views/Slide_show/slide_show_file/" . $slide_image->image; ?>" alt="" title="" width="1070" height="410"></figure>
                        </div>
                    
                    <?php } ?>
            </div>
              <div class="m-b-10"><a href="<?php echo url('/') . "/Slide_show/viewGallery/" .$data[0]->slide_show_id ; ?>" title="">click here to view slideshow list</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
