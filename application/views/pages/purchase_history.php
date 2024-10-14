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
            <div class="col-md-12 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Purchases</h5>
                </div>                
                <div class="table-responsive">
                <table class="table" style="font-size:16px;">
                  <thead>
                    <tr>
                    <th scope="col">Referrence #</th>
                      <th scope="col">Items</th>                      
                      <th scope="col">Total Amount</th>
                      <th scope="col">Status</th>
                      <th scope="col" width="20%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $totalamount=0;
                    foreach($items as $item){
                        $query=$this->Ordering_model->db->query("SELECT s.description,c.unitcost,c.quantity FROM stocks s INNER JOIN cart c ON c.code=s.code WHERE c.trans_code='$item[trans_code]'");
                        $desc=$query->result_array();
                    ?>
                    <tr>    
                      <td>
                        <?=$item['trans_code'];?>
                    </td>                  
                      <td>
                        <?php     
                        $total=0;                   
                        foreach($desc as $d){
                          echo $d['description']."<br>";
                          $total += $d['unitcost']*$d['quantity'];
                        }
                        ?>
                      </td>                      
                      <td align="right"><?=number_format($total,2);?></td>
                      <td align="right"><?=$item['status'];?></td>
                      <td>                        
                        <a
                          href="<?=base_url();?>view_invoice/<?=$item['trans_code'];?>"
                          title="Remove"
                          class="btn btn-success"                          
                        >
                          <i class="mdi mdi-eye"></i>
                          View Invoice
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
                        <td colspan="5" align="right"></td>                                            
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
          </div>       