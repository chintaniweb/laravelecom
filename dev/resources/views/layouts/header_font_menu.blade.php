<div class="nav-navbar collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li class="dropdown">

            <?php
            $page_name = Request::segment(1);

            if ($page_name == "") { ?>
                    <li class="active"><a href="<?php echo url('/'); ?>" title="">Home</a></li>
            <?php }
            else { ?>
                    <li><a href="<?php echo url('/'); ?>" title="">Home</a></li>
            <?php } ?>

        <!-- fetch all menu-->
        <?php
        $front_data = getFrontMenu();
        foreach ($front_data as $row) {

            $site_id = $row->sitecontent_id;
            $site_parent_id = $row->parent_id;

            if ($site_parent_id == 0) {
                
                if ($row->page_type == "Typical Page") {

                    $link = url('/') . '/page/' . $row->access_url;
                } 
                else {
                    $link = $row->access_url;

                    if (stristr($link, 'http')) {
                        $link = $row->access_url;
                    } else {

                        $link = url('/') . '/' . $row->access_url;
                    }
                }?>
               
                <!-- get page name-->
                
                <?php
                $page_name = Request::segment(1);
                $segment_2 = Request::segment(2);
                $active_class = "";
                
                if ($page_name == "page" && $segment_2 != "") {

                    $page_sitecontent_id = frontGetPageData($segment_2);
                    $page_id = frontGetRoot($page_sitecontent_id);

                    if ($site_id == $page_id) {
                        $active_class = "active";
                    } else {
                        $active_class = "";
                    }
                }?>

                <li class="dropdown <?php echo $active_class ?>" >

                    <a  data-hover="dropdown" href="<?php echo $link; ?>">
                        <?php echo $row->navigation_title; ?> 
                    </a>

                    <?php
                    $child_data = getChildMenu($site_id);

                    if (count($child_data) > 0) { ?>

                        <ul class="dropdown-menu">

                            <?php foreach ($child_data as $row_child) {

                                // echo $row_child['page_type'];
                                if ($row_child->page_type == "Typical Page") {

                                    $link = url('/') . '/page/' . $row_child->access_url;
                                } else {
                                    $link = $row_child->access_url;

                                    if (stristr($link, 'http')) {
                                        $link = $row_child->access_url;
                                    } else {
                                        $link = url('/') . '/' . $row_child->access_url;
                                    }
                                }?>
                                <li><a href="<?php echo $link; ?>"><?php echo $row_child->navigation_title; ?> </a></li> 
                        <?php } ?>
                        </ul>
                <?php } ?>

                </li>
        <?php }
        }?>
    </ul>
</div>