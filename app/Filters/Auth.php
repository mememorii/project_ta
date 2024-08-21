<?php


namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // IF THE USER IS NOT LOGGED IN REDIRECT TO LOGIN
        if(! session()->get('isLoggedIn')){          
              
            return redirect()->to('/');

           }

        // IF WE PASS A ROLE ARGUMENT IN THE ROUTE
        // CHECK IT MATCHES ROLE OF THE USER OR
        // REDIRECT BACK

        if (!empty($arguments)) {
    
            $role = $arguments['1'];          

            if ($role != session()->get('role')) {
                
                return redirect()->back();
            }
           
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
