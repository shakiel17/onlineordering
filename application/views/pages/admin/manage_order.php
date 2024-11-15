<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Orders Manager</h4>                    
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
                <div class="row">
                    <div class="col-12">
                        <?php
                        if($this->session->success){
                            ?>
                            <div class="alert alert-success"><?=$this->session->success;?></div>
                            <?php
                        }
                        ?>
                        <?php
                        if($this->session->failed){
                            ?>
                            <div class="alert alert-danger"><?=$this->session->failed;?></div>
                            <?php
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <table width="100%" border="0">
                                    <tr>
                                        <td><h5 class="card-title">Order List</h5></td>                                        
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">                                                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                                                
                                                <th>Transaction code</th>
                                                <th>Name</th>
                                                <th>No. of Items</th>
                                                <th>Date/Time</th>                                                
                                                <th>Payment Type</th>
                                                <th>Status</th>
                                                <th>Attachment</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                            $x=1;
                                            foreach($orders as $item){
                                                $qty=$this->Ordering_model->getQuantity($item['code']);
                                                $quantity=$qty['quantity'];
                                                    $image="<a href='data:image/jpg;charset=utf8;base64,".base64_encode($item['attachment'])."' data-toggle='modal' class='image-popup-vertical-fit el-link'><img src='data:image/jpg;charset=utf8;base64,".base64_encode($item['attachment'])."' width='70'></a>";
                                                    if($item['trantype']=="Half"){
                                                        $pay="Down payment";
                                                    }else{
                                                        $pay="Full payment";
                                                    }
                                                    if($item['status']=="booked"){
                                                        $accept="style='display:none;'";
                                                        $complete="";
                                                        $cancel="style='display:none;'";
                                                    }else{
                                                        $accept="";
                                                        $complete="style='display:none;'";
                                                        $cancel="";
                                                    }
                                                    if($item['status']=="cancel" || $item['status']=="completed"){
                                                        $accept="style='display:none;'";
                                                        $complete="style='display:none;'";
                                                        $cancel="style='display:none;'";
                                                    }
                                                echo "<tr>";
                                                    echo "<td>$x.</td>";                                                    
                                                    echo "<td>$item[trans_code]</td>";
                                                    echo "<td>$item[lastname], $item[firstname]</td>";
                                                    echo "<td align='center'>$item[no_of_items]</td>";
                                                    echo "<td align='center'>".date('m/d/Y',strtotime($item['datearray']))." ".date('h:i A',strtotime($item['timearray']))."</td>";                                                    
                                                    echo "<td align='center'>$pay</td>";
                                                    echo "<td align='center'>$item[status]</td>";
                                                    echo "<td align='center'>$image</td>";
                                                    ?>
                                                    <td align="center">
                                                        <a href="<?=base_url();?>view_invoice/<?=$item['trans_code'];?>" class="btn btn-success btn-sm">Invoice</a>
                                                        <a href="<?=base_url();?>accept_booking/<?=$item['trans_code'];?>" class="btn btn-primary btn-sm" onclick="return confirm('Do you wish to accept booking?');return false;" <?=$accept;?>>Accept</a>
                                                        <a href="<?=base_url();?>complete_booking/<?=$item['trans_code'];?>" class="btn btn-warning btn-sm" onclick="return confirm('Do you wish to complete booking?');return false;" <?=$complete;?>>Complete</a>
                                                        <a href="<?=base_url();?>cancel_booking/<?=$item['trans_code'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you wish to cancel booking?');return false;" <?=$cancel;?>>Cancel</a>
                                                    </td>
                                                    <?php
                                                echo "</tr>";
                                                $x++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                        <th>No.</th>                                                
                                                <th>Transaction code</th>
                                                <th>Name</th>
                                                <th>No. of Items</th>
                                                <th>Date/Time</th>                                                
                                                <th>Payment Type</th>
                                                <th>Status</th>
                                                <th>Attachment</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
   
            </div>
            
        </div>