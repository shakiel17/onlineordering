<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product Manager</h4>                    
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
                                        <td><h5 class="card-title">Product List</h5></td>
                                        <td align="right"><a href="" class="btn btn-primary addProduct" data-toggle="modal" data-target="#ManageProduct">Add New Product</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">                                                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Img</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Unit Cost</th>
                                                <th>Selling Price</th>
                                                <th>Quantity</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                            $x=1;
                                            foreach($products as $item){
                                                $qty=$this->Ordering_model->getQuantity($item['code']);
                                                $quantity=$qty['quantity'];
                                                echo "<tr>";
                                                    echo "<td>$x.</td>";
                                                    echo "<td></td>";
                                                    echo "<td>$item[description]</td>";
                                                    echo "<td>$item[prodtype]</td>";
                                                    echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";
                                                    echo "<td align='right'>".number_format($item['sellingprice'],2)."</td>";
                                                    echo "<td align='center'>$quantity</td>";
                                                    ?>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm editProduct" data-toggle="modal" data-target="#ManageProduct" data-id="<?=$item['id'];?>_<?=$item['description'];?>_<?=$item['prodtype'];?>_<?=$item['unitcost'];?>_<?=$item['sellingprice'];?>_<?=$item['status'];?>">Edit</a>
                                                        <a href="#" class="btn btn-info btn-sm addQuantity" data-toggle="modal" data-target="#AddQty" data-id="<?=$item['id'];?>">Add Qty</a>
                                                        <a href="<?=base_url();?>delete_product/<?=$item['code'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you wish to delete this item?');return false;">Delete</a>
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
                                                <th>Img</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Unit Cost</th>
                                                <th>Selling Price</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
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