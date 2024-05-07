<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"><b>PRODUCT CATEGORY</b></a>
                        </li>
                        <?php
                        foreach($category as $item){
                        ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url();?>view_product_category/<?=$item['prodtype'];?>" aria-expanded="false"><i class="fas fa-cart-plus"></i><span class="hide-menu"><?=$item['prodtype'];?></span></a></li>                        
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>