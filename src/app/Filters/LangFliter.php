<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LangFliter implements FilterInterface
{
    protected $session;

    protected $lang;

    public function __construct() 
    {
        $this->session = \Config\Services::session();

        $this->lang = \Config\Services::language();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $lang = $this->session->get('lang');
        

        if (empty($lang)) {
            $lang = config('App::defaultLocale');
        }

        $this->lang->setLocale($lang);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}