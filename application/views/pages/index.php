<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?=$title;?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Items</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php
                if(count($search_result)>0){                    
                ?>
                <div class="row el-element-overlay">
                    <?php
                    foreach($search_result as $item){
                        $q=$this->Ordering_model->getQuantity($item['code']);
                        $quantity=$q['quantity'];
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($item['img']);?>" alt="user" />
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="data:image/jpg;charset=utf8;base64,<?=base64_encode($item['img']);?>"><i class="mdi mdi-magnify-plus"></i></a></li>
                                            <li class="el-item"><a class="btn default btn-outline el-link addtocart" href="#" data-toggle="modal" data-target="#AddtoCart" data-id="<?=$item['code'];?>"><i class="mdi mdi-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h4 class="m-b-0"><?=$item['description'];?></h4> <span><b>P <?=number_format($item['sellingprice'],2);?></b></span><br><span class="text-muted">Stocks: <?=$quantity;?></span>
                                </div>
                            </div>
                        </div>
                    </div>                                        
                    <?php
                    }
                    ?>
                </div>               
                <?php                    
                }else{                    
                    foreach($category as $item){
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><h3 class="card-title"><?=$item['prodtype'];?></h3></td>
                                            <td align="right"><a href="<?=base_url();?>view_product_category/<?=$item['prodtype'];?>">View All</a></td>
                                        </tr>
                                    </table>                                    
                                    <div class="row">
                                        <div class="row el-element-overlay">
                                        <?php
                                        $query=$this->Ordering_model->getProductByCategory($item['prodtype']);
                                        foreach($query as $row){
                                            $q=$this->Ordering_model->getQuantity($item['code']);
                                            $quantity=$q['quantity'];
                                        ?>                                        
                                            <div class="col-lg-2 col-md-6">
                                                <div class="card">
                                                    <div class="el-card-item">
                                                        <div class="el-card-avatar el-overlay-1"> <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['img']);?>"/>
                                                            <div class="el-overlay">
                                                                <ul class="list-style-none el-info">
                                                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['img']);?>"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                                    <li class="el-item"><a class="btn default btn-outline el-link addtocart" href="#" data-toggle="modal" data-target="#AddtoCart" data-id="<?=$item['code'];?>"><i class="mdi mdi-cart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="el-card-content">
                                                            <h4 class="m-b-0"><?=$row['description'];?></h4> <span class="text-muted">P <?=number_format($row['sellingprice'],2);?></span><br><span class="text-muted">Stocks: <?=$quantity;?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                    }
                }
                ?>
            </div>            
        </div>