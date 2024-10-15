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
                    <li class="breadcrumb-item active" aria-current="page">
                      Invoice
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

          <?php
          $book_date="";
          $book_due="";
          $address="";
          $fullname="";
          foreach($items as $row){
            if($row['book_date'] <> "0000-00-00" && $row['book_date'] <> ""){
              $book_date=date('dS M Y',strtotime($row['book_date']));            
              $book_due=date('dS M Y',strtotime('2 days',strtotime($row['book_date']))); 
            }else{
              $book_date="TBA";
              $book_due="TBA";
            }            
            $address=$row['address'];
            $fullname=$row['firstname'];
          }
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-body printableArea">
                <h3><b>INVOICE</b> <span class="pull-right"><?=$refno;?></span></h3>
                <hr />
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-left">
                      <address>
                        <h3>
                          &nbsp;<b class="text-danger">AJ CONSTRUCTION SUPPLIES</b>
                        </h3>
                        <p class="text-muted ms-1">
                          E 104, Dharti-2, <br />
                          Nr' Viswakarma Temple, <br />
                          Talaja Road, <br />
                          Bhavnagar - 364002
                        </p>
                      </address>
                    </div>
                    <div class="pull-right text-right">
                      <address>
                        <h3>To,</h3>
                        <h4 class="font-bold"><?=$fullname;?></h4>
                        <p class="text-muted ms-4">
                          <?=$address;?>
                        </p>
                        <p class="mt-4">
                          <b>Invoice Date :</b>
                          <i class="mdi mdi-calendar"></i> <?=$book_date;?>
                        </p>
                        <p>
                          <b>Due Date :</b>
                          <i class="mdi mdi-calendar"></i> <?=$book_due;?>
                        </p>
                      </address>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="table-responsive mt-5" style="clear: both">
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
                                $query=$this->Ordering_model->db->query("SELECT * FROM stocks WHERE code='$item[code]'");
                                $desc=$query->row_array();
                            ?>
                            <tr>
                                <td class="text-center"><?=$x;?></td>
                                <td><?=$desc['description'];?></td>
                                <td class="text-end"><?=$item['quantity'];?></td>
                                <td class="text-end"><?=number_format($item['unitcost'],2);?></td>
                                <td class="text-end"><?=number_format($item['unitcost']*$item['quantity'],2);?></td>
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
                      
                      <hr />
                      <h3><b>Total :</b> P <?=number_format($totalamount,2);?></h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <div class="text-end">                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>