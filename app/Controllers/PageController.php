<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class PageController extends BaseController
{
    public function view($page = "home")
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page);
        
        return view('templates/header', $data).view('pages/'.$page).view('templates/footer');
    }
}