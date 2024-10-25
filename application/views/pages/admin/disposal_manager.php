<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?=$title;?></h4>                    
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
                    <div class="col-6">
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
                                        <td><h5 class="card-title">Reference No. (<?=$refno;?>)</h5></td>
                                        <td align="right">
                                            <form action="<?=base_url();?>post_disposal" method="POST" onsubmit="return confirm('Do you wish  to post disposal?');return false;">                                                
                                                <input type="hidden" name="refno" value="<?=$refno;?>">
                                            <?php                                            
                                            if(count($items) > 0){
                                                ?>
                                                <input type="submit" class="btn btn-primary" value="Post Disposal">
                                                <?php
                                            }
                                            ?>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">                                                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%">No.</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Quantity</th>                                                
                                                <th>Unit Cost</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                            $x=1;
                                            foreach($items as $item){                                                                                                                                                
                                                echo "<tr>";
                                                    echo "<td>$x.</td>";                                                    
                                                    echo "<td>$item[refno]</td>";                                                    
                                                    echo "<td>$item[description]</td>";
                                                    echo "<td align='center'>$item[quantity]</td>";
                                                    echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";                                                                                                        
                                                    ?>
                                                    <td>
                                                        <a href="<?=base_url();?>remove_from_disposal/<?=$item['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you wish to remove this item?'); return false;">Remove</a>                                                        
                                                    </td>
                                                    <?php
                                                echo "</tr>";
                                                $x++;
                                            }
                                            ?>
                                        </tbody>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">                       
                        <div class="card">
                            <div class="card-header">
                                <table width="100%" border="0">
                                    <tr>
                                        <td><h5 class="card-title">Item List</h5></td>
                                        <td align="right"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">                                                                
                                <div class="table-responsive">
                                <form action="<?=base_url();?>add_to_disposal" method="POST">                                        
                                <input type="hidden" name="refno" value="<?=$refno;?>">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%">No.</th>                                                
                                                <th>Description</th>
                                                <th>SOH</th>                                                                              
                                                <th>Unit Cost</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>                                                                                
                                        <tbody>
                                            <?php                                            
                                            $x=1;
                                            foreach($products as $item){
                                                $qty=$this->Ordering_model->getQuantity($item['code']);
                                                echo "<tr>";
                                                    echo "<td>$x.</td>";                                                                                                        
                                                    echo "<td>$item[description]</td>";                        
                                                    echo "<td>$qty[quantity]</td>";                                                    
                                                    echo "<td>$item[unitcost]</td>";
                                                    ?>
                                                    <td>
                                                        <input type="checkbox" name="code[]" value="<?=$item['code'];?>">
                                                    </td>
                                                    <?php
                                                echo "</tr>";                                                
                                                $x++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Quantity</label>
                                                </td>
                                                <td colspan="2">                                                    
                                                    <input type="text" name="quantity" class="form-control">                                                    
                                                </td>
                                                <td coslpan="2">
                                                    <input type="submit" class="btn btn-success" value="Add">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                        </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
   
            </div>
            
        </div>