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
                    <li class="breadcrumb-item"><a href="<?=base_url();?>manage_report">Report</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Sales Report
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
            <div class="col-md-12">
              <div class="card card-body printableArea">
                <h3><b>Date:</b> <span class="pull-right"><?=date('m/d/Y',strtotime($rundate));?></span></h3>
                <hr />
                <div class="row">                  
                  <div class="col-md-12">
                    <div class="table-responsive" style="clear: both">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Description</th>
                            <th class="text-end">Quantity</th>
                            <th class="text-end">Unit Cost</th>
                            <th class="text-end">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x=1;
                            $totalamount=0;
                            foreach($items as $item){                                
                                ?>
                                <tr>
                                <td class="text-center"><?=$x;?>.</td>
                                <td><?=$item['description'];?></td>
                                <td class="text-end"><?=$item['quantity'];?></td>
                                <td class="text-right"><?=number_format($item['unitcost'],2);?></td>
                                <td class="text-right"><?=number_format($item['unitcost']*$item['quantity'],2);?></td>
                            </tr>                          
                                <?php
                                $totalamount += $item['unitcost']*$item['quantity'];
                                $x++;
                            }
                            $refund=0;
                            $check=$this->Ordering_model->db->query("SELECT SUM(amount) as refund FROM sales WHERE remarks='Refund' AND datearray='$rundate' GROUP BY remarks");
                            if($check->num_rows() > 0){
                                $res=$check->row_array();
                                $refund=$res['refund'];                                
                            }                
                            if($refund==""){
                                $refund=0;
                            }
                            ?>                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="pull-right mt-4 text-end">
                        <p>Sub - Total amount: <?=number_format($totalamount,2);?></p>
                        <p>Refund: <?=number_format($refund,2);?></p>                     
                      <hr />
                      <h3><b>Total Sales:</b> <?=number_format($totalamount-abs($refund),2);?></h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <div class="text-end">
                      <!-- <button class="btn btn-danger text-white" type="submit">
                        Proceed to payment
                      </button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>