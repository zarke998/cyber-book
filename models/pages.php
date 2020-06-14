<?php 
    class Pages{
        const Home = 0;
        const Shop = 1;
        const Contact = 2;
        const About = 3;
        const Login = 4;
        const Register = 5;
        const Admin = 6;
        const Admin_Add_Book = 7;
        const Admin_Update_Book = 8;
        const Admin_Delete_Book = 9;
    }

    function get_page_name($id){
        switch($id){
            case 0: return "Home"; break;
            case 1: return "Shop"; break;
            case 2: return "Contact"; break;
            case 3: return "About"; break;
            case 4: return "Login"; break;
            case 5: return "Register"; break;
            case 6: return "Admin"; break;
            case 7: return "Admin Add Book"; break;
            case 8: return "Admin Update Book"; break;
            case 9: return "Admin Delete Book"; break;
            default: return null; break;
        }
    }
?>