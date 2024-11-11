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
                    <li class="breadcrumb-item"><a href="#<?=base_url();?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Cart
                    </li>
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
          <div class="row">            
            <div class="col-md-8 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Items</h5>
                </div>
                <?=form_open_multipart(base_url()."checkout",array("onsubmit" => "return confirm('Do you wish to checkout these times?');return false;"));?>
                <div class="table-responsive">
                <table class="table" style="font-size:16px;">
                  <thead>
                    <tr>
                    <th scope="col"></th>
                      <th scope="col">Description</th>
                      <th scope="col" width="10%">Price</th>
                      <th scope="col" width="20%">Quantity</th>
                      <th scope="col">Total</th>
                      <th scope="col" width="20%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $totalamount=0;
                    foreach($items as $item){
                        $query=$this->Ordering_model->db->query("SELECT * FROM stocks WHERE code='$item[code]'");
                        $desc=$query->row_array();
                    ?>
                    <tr>
                      <td align="center"><input type="checkbox" name="code[]" value="<?=$item['id'];?>" class="checkbox"></td>
                      <td><?=$desc['description'];?></td>
                      <td align="right"><?=number_format($item['unitcost'],2);?></td>
                      <td><a href="<?=base_url();?>update_quantity/<?=$item['id'];?>/deduct" class="btn btn-info btn-sm"  style="width:50px;">-</a> <input type="text" name="quantity[]" value="<?=$item['quantity'];?>" style="width:50px; text-align:center;" id="cart_qty"> <a href="<?=base_url();?>update_quantity/<?=$item['id'];?>/add" class="btn btn-info btn-sm"  style="width:50px;">+</a></td>
                      <td align="right"><?=number_format($item['unitcost']*$item['quantity'],2);?></td>
                      <td>                        
                        <a
                          href="<?=base_url();?>update_quantity/<?=$item['id'];?>/remove"                          
                          title="Remove"
                          class="btn btn-danger"
                          onclick="return confirm('Do you wish to remove this item?');return false;"
                        >
                          <i class="mdi mdi-close"></i>
                        </a>
                      </td>
                    </tr>
                    <?php
                    $totalamount += $item['unitcost']*$item['quantity'];
                    }
                    if(count($items) > 0){
                        $view="";
                    }else{
                        $view="style='display:none;'";
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <td colspan="4" align="right"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                </table>
                  </div>
              </div>
              <!-- card new -->
              
              <!-- Tabs -->
             
              <!-- Card -->
             
              <!-- card -->
              
            </div>  
          <!-- row -->
           <input type="text" name="totalamount" value="<?=$totalamount;?>">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Checkout Details</h5>
                </div>
                <table class="table">                  
                  <tbody>
                    <tr>
                      <td>Total Amount</td>
                      <td align="right"><?=number_format($totalamount,2);?></td>
                    </tr>                    
                    <tr>
                      <td>Payment Type</td>
                      <td>
                        <select name="payment_type" class="form-control" required>
                            <option value="">Select Payment Type</option>
                            <option value="Half">Down payment</option>
                            <option value="Full">Full payment</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                      <td>Amount Paid</td>
                      <td align="right"><input type="text" name="amount" class="form-control" required></td>
                    </tr>
                    <tr>
                      <td>Attachment:</td>
                      <td><input type="file" name="file" class="form-control" required></td>
                    </tr>
                    <tr>
                      <td><input type="submit" class="btn btn-primary btn-lg" value="Checkout" <?=$view;?>></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>  
            <?=form_close();?>         
          </div>       