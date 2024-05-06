<?php
    ini_set('max_execution_time', 0);
    ini_set('memory_limit','2048M');
    date_default_timezone_set('Asia/Manila');
    class Pages extends CI_Controller{
        public function index(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }
        
            $this->load->view('templates/header');
            $this->load->view('templates/user/navbar');
            $this->load->view('templates/user/sidebar');
            $this->load->view('pages/'.$page);    
            $this->load->view('templates/user/modal');        
            $this->load->view('templates/user/footer');
        }

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
        
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar');
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
            $this->load->view('templates/header');
            $this->load->view('templates/admin/navbar');
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
    }
?>