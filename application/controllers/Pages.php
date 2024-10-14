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
            $refno="RN".date('YmdHis');
            $checkout=$this->Ordering_model->checkout($refno);
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
        //======================Admin Module===============================
    }
?>