 <?php   
    date_default_timezone_set('Asia/Manila');
    class Ordering_model extends CI_model{
        public function __construct(){
            $this->load->database();
        }
        public function admin_authentication(){
            $password=$this->input->post('password');
            $result=$this->db->query("SELECT * FROM `admin` WHERE `password` = '$password'");
            if($result->num_rows() > 0){
                return $result->row_array();
            }else{
                return false;
            }
        }
        public function getAllProducts(){
            $result=$this->db->query("SELECT * FROM stocks ORDER BY `description` ASC");
            return $result->result_array();
        }
        public function save_product(){
            $id=$this->input->post('id');            
            $description=$this->input->post('description');
            $prodtype=$this->input->post('category');
            $unitcost=$this->input->post('unitcost');
            $sellingprice=$this->input->post('sellingprice');
            $status=$this->input->post('status');
            $max=$this->input->post('max_level');
            $min=$this->input->post('min_level');
            $datearray=date('Y-m-d');
            $timearray=date('H:i:s');
            if($id==""){
                $code=date('YmdHis');
                $result=$this->db->query("INSERT INTO stocks(code,`description`,prodtype,unitcost,sellingprice,`status`,datearray,timearray,critical_level,max_level) VALUES('$code','$description','$prodtype','$unitcost','$sellingprice','$status','$datearray','$timearray','$min','$max')");                
                if($result){
                    $result1=$this->db->query("INSERT INTO stocktable(code,unitcost,quantity,trantype,datearray,timearray) VALUES('$code','$sellingprice','1','add','$datearray','$timearray')");
                    if($result1){                       
                        return true;
                    }else{
                        $this->db->query("DELETE FROM stocks WHERE code='$code'");
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                $result=$this->db->query("UPDATE stocks SET description='$description',prodtype='$prodtype',unitcost='$unitcost',sellingprice='$sellingprice',`status`='$status',critical_level='$min',max_level='$max' WHERE id='$id'");
                if($result){
                    $result1=$this->db->query("UPDATE stocktable SET unitcost='$sellingprice' WHERE id='$id'");
                    if($result1){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }
        public function getQuantity($code){
            $result=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE code='$code' GROUP BY code");
            return $result->row_array();
        }
        public function add_quantity(){
            $id=$this->input->post('id');
            $quantity=$this->input->post('quantity');
            $query=$this->db->query("SELECT * FROM stocks WHERE id='$id'");
            $item=$query->row_array();
            $code=$item['code'];
            $unitcost=$item['sellingprice'];
            $datearray=date('Y-m-d');
            $timearray=date('H:i:s');
            
            $result=$this->db->query("INSERT INTO stocktable(code,unitcost,quantity,trantype,datearray,timearray) VALUES('$code','$unitcost','$quantity','adjustment','$datearray','$timearray')");
            if($result){
                return true;
            }else{
                return false;
            }            
        }
        public function delete_product($code){
            $result=$this->db->query("DELETE FROM stocktable WHERE code='$code'");
            if($result){
                $this->db->query("DELETE FROM stocks WHERE code='$code'");
                return true;
            }else{
                return false;
            }
        }
        public function save_product_image(){
            $id=$this->input->post('id');
            $fileName=basename($_FILES["file"]["name"]);
            $fileType=pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType,$allowTypes)){
                $image = $_FILES["file"]["tmp_name"];
                $imgContent=addslashes(file_get_contents($image));
                $result=$this->db->query("UPDATE stocks SET `img`='$imgContent' WHERE id='$id'");            
            }else{
                return false;
            }            
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getSingleProduct($id){
            $result=$this->db->query("SELECT * FROM stocks WHERE `id`='$id'");
            return $result->row_array();
        }
        public function getAllOrders(){
            $result=$this->db->query("SELECT *,COUNT(code) as no_of_items FROM cart WHERE trans_code <> '' GROUP BY username,trans_code ORDER BY datearray DESC");
            return $result->result_array();
        }
        public function getAllProductsByCategory(){
            $result=$this->db->query("SELECT * FROM stocks GROUP BY prodtype ORDER BY prodtype ASC");
            return $result->result_array();
        }
        public function getProductByCategory($category){
            $result=$this->db->query("SELECT * FROM stocks WHERE prodtype='$category'");
            return $result->result_array();
        }    
        public function user_authentication(){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $result=$this->db->query("SELECT * FROM customer WHERE username='$username' AND `password`='$password'");
            if($result){
                return $result->row_array();
            }else{
                return false;
            }
        }
        public function user_registration(){
            $fullname=$this->input->post('fullname');
            $contactno=$this->input->post('contactno');
            $address=$this->input->post('address');
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $datearray=date('Y-m-d');
            $timearray=date('H:i:s');
            $check=$this->db->query("SELECT * FROM customer WHERE username = '$username'");
            if($check->num_rows()>0){
                return false;
            }else{
                $result=$this->db->query("INSERT INTO customer(fullname,contactno,`address`,username,`password`,datearray,timearray) VALUES('$fullname','$contactno','$address','$username','$password','$datearray','$timearray')");
            }
            if($result){
                $result=$this->db->query("SELECT * FROM customer WHERE username='$username' AND `password`='$password'");
                return $result->row_array();
            }else{
                return false;
            }            
        }    
        public function getProductByDescription(){
            $description=$this->input->post('description');
            $result=$this->db->query("SELECT * FROM stocks WHERE `description` LIKE '%$description%' OR prodtype LIKE '%$description%' ORDER BY `description` ASC");            
            if(count($result->result_array())==0){
                $this->session->set_flashdata('failed','No record found!');
            }else{
                $this->session->set_flashdata('failed','');
            }
            return $result->result_array();                     
        }
        public function add_to_cart($id,$quantity){
            $username=$this->session->username;
            $fullname=$this->session->fullname;
            $query=$this->db->query("SELECT * FROM customer WHERE username='$username'");
            $user=$query->row_array();
            $address=$user['address'];
            $contactno=$user['contactno'];
            $query=$this->db->query("SELECT * FROM stocks WHERE code='$id'");
            $item=$query->row_array();
            $unitcost=$item['unitcost'];
            $query=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$id' GROUP BY code");
            $row=$query->row_array();
            $soh=$row['soh'];
            $date=date('Y-m-d');
            $time=date('H:i:s');
            $check=$this->db->query("SELECT * FROM cart WHERE trans_code='' AND `status`='pending' AND code='$id' AND username='$username'");
            if($check->num_rows()>0){
                $r=$check->row_array();
                $qty=$r['quantity'];
                $cid=$r['id'];
                $totalqty=$qty+$quantity;
                if($soh >= $totalqty){
                    $result=$this->db->query("UPDATE cart SET quantity='$totalqty' WHERE id='$cid'");
                }
            }else{
                if($soh >= $quantity){
                    $result=$this->db->query("INSERT INTO cart(username,firstname,`address`,contactno,email,trans_code,code,quantity,unitcost,trantype,datearray,timearray) VALUES('$username','$fullname','$address','$contactno','','','$id','$quantity','$unitcost','','$date','$time')");
                }
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getAllItemCart($username,$status){
            $result=$this->db->query("SELECT * FROM cart WHERE username='$username' AND `status`='$status'");
            return $result->result_array();
        }
        public function changeqty($id,$type){
            $query=$this->db->query("SELECT * FROM cart WHERE id='$id'");
            $item=$query->row_array();
            if($type=="deduct"){
                $qty=$item['quantity']-1;
            }else if($type=="add"){
                $qty=$item['quantity']+1;
            }else{
                $qty=0;
            }
            if($qty <= 0){
                $result=$this->db->query("DELETE FROM cart WHERE id='$id'");
            }else{
                $result=$this->db->query("UPDATE cart SET quantity='$qty' WHERE id='$id'");
            }            
        }
    }
?>