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
                      Disposal Report
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
                <h3><b>Month of:</b> <span class="pull-right"><?=date('F Y',strtotime($startdate));?></span></h3>
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
                            <th class="text-end">Date</th>
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
                                <td class="text-center"><?=date('m/d/Y',strtotime($item['datearray']));?></td>
                            </tr>                          
                                <?php
                                $totalamount += $item['unitcost']*$item['quantity'];
                                $x++;
                            }
                            ?>                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="pull-right mt-4 text-end">
                        <p>Sub - Total amount: <?=number_format($totalamount,2);?></p>                                       
                      <hr />
                      <h3><b>Total Amount Manufacture:</b> <?=number_format($totalamount,2);?></h3>
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