<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Dinum
 * Login Controller
 */
class Messages {
        
    public function returnMessage($id){
        $CI =& get_instance();
        
        switch ($id) {
            case 1:
                return "<div class='alert alert-success' role='alert'>Successfully Updated</div>";
                break;
            
            case 2:
                return "<div class='alert alert-danger' role='alert'>Error in Update</div>";
                break;
            
            case 3:
                return "<div class='alert alert-danger' role='alert'>Error in Delete</div>";
                break;
            
            case 4:
                return "<div class='alert alert-success' role='alert'>Successfully Deleted</div>";
                break;
            case 5:
                return "<div class='alert alert-success' role='alert'>Successfully Added</div>";
                break;
            case 6:
                return "<div class='alert alert-danger' role='alert'>Error in Adding Data</div>";
                break; 
            
            case 7:
                return "<div class='alert alert-danger' role='alert'>Error in Uploading Image.for more info,check log</div>";
                break;
            
            case 8:
                return "<div class='alert alert-success'>Wellcome to ".$CI->session->userdata('company_name').". Administration Panel</div>";
                break;
            case 9:
                return "<div class='alert alert-danger' role='alert'>Invalid Selection</div>";
                break;
            case 10:
                return "<div class='alert alert-danger' role='alert'>Invalid User Name or Password</div>";
                break;
            case 11:
                return "<div class='alert alert-warning' role='alert'>Please Login</div>";
                break;
            case 12:
                return "<div class='alert alert-danger validator' role='alert'>Please Enter Valid Name</div>";
                break;
            case 13:
                return "<div class='alert alert-danger validator' role='alert'>Please Select at least 1 Value</div>";
                break;
            case 14:
                return "<div class='alert alert-danger validator' role='alert'>Please Enter Valid Email</div>";
                break;
           case 15:
                return "<div class='alert alert-danger validator' role='alert'>Please Enter Valid User Name</div>";
                break; 
            case 16:
                return "<div class='alert alert-danger validator' role='alert'>User name already taken</div>";
                break; 
            case 17:
                return "<div class='alert alert-danger validator' role='alert'>Please enter valid password</div>";
                break; 
            case 18:
                return "<div class='alert alert-danger validator' role='alert'>Password not matched</div>";
                break; 
            case 19:
                return "<div class='alert alert-danger validator' role='alert'>Invalid Category</div>";
                break;
            case 20:
                return "<div class='alert alert-danger validator' role='alert'>Invalid Password</div>";
                break;
            default:
                return "<div class='alert alert-warning' role='alert'>Unknown Error, Please Contact Administrator</div>";
                break;
        }
    }
}
