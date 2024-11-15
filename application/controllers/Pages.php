<?php
    ini_set('max_execution_time', 0);
    ini_set('memory_limit','2048M');
    date_default_timezone_set('Asia/Manila');
    class Pages extends CI_Controller{
        //======================User Module===============================
        public function index(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "Store Items";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['search_result'] = array();  
            if($this->session->admin_login)          {
                redirect(base_url()."admin");
            }
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function view_product_category($category){
            $category=str_replace('%20',' ',$category);
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = $category;
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['search_result'] = $this->Ordering_model->getProductByCategory($category);            
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function view_product_details($id){            
            $page = "product_details";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            if($this->session->user_login){

            }else{
                redirect(base_url()."user_login");
            }
            $data['title'] = "Product Details";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['details'] = $this->Ordering_model->getSingleProduct($id);
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function user_login(){
            $page = "user_login";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }           
            $this->load->view('pages/'.$page);                
        }
        public function user_authentication(){
            $data=$this->Ordering_model->user_authentication();
            if($data){
                $user_data=array(
                    'username' => $data['username'],
                    'fullname' => $data['fullname'],                    
                    'contactno' => $data['contactno'],
                    'user_login' => true
                );
                $this->session->set_userdata($user_data);
                redirect(base_url());
            }else{
                $this->session->set_flashdata('error','Invalid username and password!');
                redirect(base_url()."user_login");
            }
        }
        public function user_registration(){
            $data=$this->Ordering_model->user_registration();            
            if($data){
                $user_data=array(
                    'username' => $data['username'],
                    'fullname' => $data['fullname'],                    
                    'contactno' => $data['contactno'],
                    'user_login' => true
                );
                $this->session->set_userdata($user_data);
                redirect(base_url());
            }else{
                echo "<script>alert('Unable to save customer data!');window.history.back();</script>";
            }
        }
        public function user_logout(){
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('contactno');
            $this->session->unset_userdata('user_login');
            redirect(base_url());
        }
        public function search_product(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "Store Items";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['search_result'] = $this->Ordering_model->getProductByDescription();                                 
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function add_to_cart(){
            $id=$this->input->post('id');
            $quantity=$this->input->post('quantity');
            $add=$this->Ordering_model->add_to_cart($id,$quantity);
            if($add){
                echo "<script>alert('Item successfully added to cart!');window.location='".base_url()."';</script>";
            }else{
                echo "<script>alert('Unable to add item to cart!');window.history.back();</script>";
            }

        }
        public function manage_cart(){
            $page = "cart";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "My Cart";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['items'] = $this->Ordering_model->getAllItemCart($this->session->username,"pending","");                                 
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function update_quantity($id,$type){
            $this->Ordering_model->changeqty($id,$type);
            redirect(base_url()."manage_cart");
        }
        public function checkout(){
            $totalamount=$this->input->post('totalamount');
            $amount=$this->input->post('amount');
            $dp=$totalamount/2;
            if($amount>=$dp){
                $refno="RN".date('YmdHis');
                $checkout=$this->Ordering_model->checkout($refno);
            }
            if($checkout){
                echo "<script>alert('Order successfully checked out!');window.location='".base_url()."view_invoice/$refno';</script>";
            }else{
                echo "<script>alert('Unable to checkout order!');window.location='".base_url()."manage_cart';</script>";
            }
        }
        public function view_invoice($refno){
            $page = "invoice";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "Order Invoice";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['items'] = $this->Ordering_model->getAllItemCartInvoice($this->session->username,$refno);
            $data['refno'] = $refno;
            $data['pending'] = $this->Ordering_model->getPendingOrders();

            if($this->session->user_login){
                $this->load->view('templates/header');
                $this->load->view('templates/user/navbar');
                $this->load->view('templates/user/sidebar',$data);
                $this->load->view('pages/'.$page,$data);    
                $this->load->view('templates/user/modal');        
                $this->load->view('templates/user/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/admin/navbar',$data);
                $this->load->view('templates/admin/sidebar');
                $this->load->view('pages/'.$page,$data);    
                $this->load->view('templates/admin/modal');        
                $this->load->view('templates/admin/footer');
            }            
        }
        public function purchase_history(){
            $page = "purchase_history";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "Purchase Hsitory";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['items'] = $this->Ordering_model->getAllPurchases();
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }
        public function user_profile(){
            $page = "user_profile";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
            $data['title'] = "My Profile";
            $data['category'] = $this->Ordering_model->getAllProductsByCategory();
            $data['item'] = $this->Ordering_model->getUserProfile();
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar',$data);
            $this->load->view('pages/'.$page,$data);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }

        public function update_profile(){
            $fullname=$this->input->post('fullname');
            $update=$this->Ordering_model->update_profile();
            if($update){
                $this->session->set_flashdata('success','Profile successfully updated!');
                $this->session->set_userdata('fullname',$fullname);
            }else{
                $this->session->set_flashdata('failed','Unable to update profile!');
            }
            redirect(base_url()."user_profile");
        }

        public function cancel_user_booking($refno,$status){            
            $update=$this->Ordering_model->cancel_user_booking($refno,$status);
            if($update){
                echo "<script>alert('Booking successfully cancelled!');window.location='".base_url()."purchase_history';</script>";
            }else{
                echo "<script>alert('Unable to cancel booking!');window.location='".base_url()."purchase_history';</script>";
            }            
        }
        //======================User Module===============================

        //======================Admin Module===============================
        public function admin(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }             
            if($this->session->admin_login){
                redirect(base_url()."admin_main");
            }   
            $this->load->view('pages/admin/'.$page);            
        }
        public function admin_authentication(){
            $data=$this->Ordering_model->admin_authentication();
            if($data){
                $user_data=array(
                    'usernames' => $data['username'],
                    'fullname' => $data['fullname'],
                    'admin_login' => true
                );
                $this->session->set_userdata($user_data);                
                redirect(base_url()."admin_main");
            }else{
                $this->session->set_flashdata('failed','Invalid Password!');
                redirect(base_url()."admin");
            }            
        }
        public function admin_logout(){
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('admin_login');
            redirect(base_url()."admin");
        }
        public function admin_main(){
            $page = "main";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function manage_product(){
            $page = "manage_product";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }
            $data['products'] = $this->Ordering_model->getAllProducts();
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function save_product(){
            $save=$this->Ordering_model->save_product();
            if($save){
                $this->session->set_flashdata('success','Product details successfully saved!');
            }else{
                $this->session->set_flashdata('failed','Unable to save product details!');
            }
            redirect(base_url().'manage_product');
        }
        public function add_quantity(){
            $save=$this->Ordering_model->add_quantity();
            if($save){
                $this->session->set_flashdata('success','Product quantity successfully saved!');
            }else{
                $this->session->set_flashdata('failed','Unable to save product quantity!');
            }
            redirect(base_url().'manage_product');
        }
        public function delete_product($code){
            $save=$this->Ordering_model->delete_product($code);
            if($save){
                $this->session->set_flashdata('success','Product details successfully deleted!');
            }else{
                $this->session->set_flashdata('failed','Unable to delete product details!');
            }
            redirect(base_url().'manage_product');
        }
        public function save_product_image(){
            $save=$this->Ordering_model->save_product_image();
            if($save){
                $this->session->set_flashdata('success','Product image successfully saved!');
            }else{
                $this->session->set_flashdata('failed','Unable to save product image!');
            }
            redirect(base_url().'manage_product');
        }
        public function view_product_image($id){
            $page="product_image";
            $data['image'] = $this->Ordering_model->getSingleProduct($id);
            $this->load->view('pages/admin/'.$page,$data);
        }
        public function manage_order(){
            $page = "manage_order";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }
            $data['orders'] = $this->Ordering_model->getAllOrders();
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function accept_booking($refno){
            $save=$this->Ordering_model->accept_booking($refno);
            if($save){
                $this->session->set_flashdata('success','Booking successfully accepted!');
            }else{
                $this->session->set_flashdata('failed','Unable to save booking status!');
            }
            redirect(base_url().'manage_order');
        }
        public function cancel_booking($refno){
            $save=$this->Ordering_model->cancel_booking($refno);
            if($save){
                $this->session->set_flashdata('success','Booking successfully cancelled!');
            }else{
                $this->session->set_flashdata('failed','Unable to cancel booking!');
            }
            redirect(base_url().'manage_order');
        }
        public function complete_booking($refno){
            $save=$this->Ordering_model->complete_booking($refno);
            if($save){
                $this->session->set_flashdata('success','Booking successfully completed!');
            }else{
                $this->session->set_flashdata('failed','Unable to complete booking!');
            }
            redirect(base_url().'manage_order');
        }

        public function manage_report(){
            $page = "reports";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $data['title'] = 'Reports';
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function daily_sales(){
            $page = "daily_sales";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $rundate=$this->input->post('rundate');
            $data['title'] = 'Daily Sales Report';
            $data['rundate'] = $rundate;
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getDailySales($rundate);
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function weekly_sales(){
            $page = "weekly_sales";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $startdate=$this->input->post('startdate');
            $enddate=$this->input->post('enddate');
            $data['title'] = 'Weekly Sales Report';
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getWeeklySales($startdate,$enddate);
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function monthly_sales(){
            $page = "monthly_sales";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $startdate=$this->input->post('startdate');
            $enddate=$this->input->post('enddate');
            $data['title'] = 'Monhtly Sales Report';
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getWeeklySales($startdate,$enddate);
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function manage_disposal(){
            $page = "manage_disposal";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }                        
            $this->session->unset_userdata('refno');
            $data['title'] = 'Item Disposal Manager';            
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getAllDisposalByStatus("pending");
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function new_disposal(){
            $refno=date('YmdHis');
            $this->session->set_userdata('refno',$refno);
            redirect(base_url()."disposal_manager");
        }
        public function edit_disposal($refno){            
            $this->session->set_userdata('refno',$refno);
            redirect(base_url()."disposal_manager");
        }
        public function disposal_manager(){
            $page = "disposal_manager";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }                                    
            $refno=$this->session->refno;
            $data['title'] = 'Item Disposal Manager';            
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getAllDisposalByRefNo($refno,"pending");
            $data['products'] = $this->Ordering_model->getAllProducts();
            $data['refno'] = $refno;
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function add_to_disposal(){
            $refno=$this->input->post('refno');
            $code=$this->input->post('code');
            $quantity=$this->input->post('quantity');
            foreach($code as $id){
                $save=$this->Ordering_model->add_to_disposal($refno,$id,$quantity);
            }            
            if($save){
                $this->session->set_flashdata('success','Item successfully added!');
            }else{
                $this->session->set_flashdata('failed','Unable to add item!');
            }
            redirect(base_url().'disposal_manager');
        }
        public function remove_from_disposal($id){            
            $save=$this->Ordering_model->remove_from_disposal($id);            
            if($save){
                $this->session->set_flashdata('success','Item successfully removed!');
            }else{
                $this->session->set_flashdata('failed','Unable to remove item!');
            }
            redirect(base_url().'disposal_manager');
        }
        public function post_disposal(){            
            $save=$this->Ordering_model->post_disposal();  
            if($save){
                $this->session->set_flashdata('success','Tramsaction successfully posted!');
            }else{
                $this->session->set_flashdata('failed','Unable to post transaction!');
            }
            redirect(base_url().'manage_disposal');
        }
        public function monthly_disposal(){
            $page = "monthly_disposal";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $startdate=$this->input->post('startdate');
            $enddate=$this->input->post('enddate');
            $data['title'] = 'Monhtly Disposal Report';
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getMonthlyDisposal($startdate,$enddate);
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        public function monthly_manufacture(){
            $page = "monthly_manufacture";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }

            if($this->session->admin_login){

            }else{
                $this->session->set_flashdata('failed','You are not logged in! Please login.');
                redirect(base_url()."admin");
            }            
            $startdate=$this->input->post('startdate');
            $enddate=$this->input->post('enddate');
            $data['title'] = 'Monhtly Manufacture Report';
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['pending'] = $this->Ordering_model->getPendingOrders();
            $data['items'] = $this->Ordering_model->getMonthlyManufacture($startdate,$enddate);
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar',$data);
            $this->load->view('templates/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);    
            $this->load->view('templates/admin/modal');        
            $this->load->view('templates/admin/footer');
        }
        //======================Admin Module===============================
    }
?>