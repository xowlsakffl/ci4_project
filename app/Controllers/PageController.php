<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class PageController extends Controller
{
    public function view($page)
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['tile'] = $page ? $page : "home";

        return view('templates/header', $data).view('pages/about').view('templates/footer');
    }
}