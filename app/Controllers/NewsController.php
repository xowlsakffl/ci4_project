<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\News;

class NewsController extends BaseController
{
    public function index()
    {
        $news = model(News::class);

        $data = [
            'news' => $news->getNews(),
            'title' => 'News',
        ];
        
        return view('templates/header', $data).view('news/overview').view('templates/footer');
    }

    public function view($slug = null)
    {
        $news = model(News::class);

        $data = [
            'news' => $news->getNews($slug),
            'title' => 'NewsItem',
        ];

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }
        
        return view('templates/header', $data).view('news/view').view('templates/footer');
    }

    public function create()
    {
        $news = model(News::class);
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
            'slug' => 'required',
        ])) {
            
            $news->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('slug'), '-', true),
                'body' => $this->request->getPost('body'),
            ]);

            return redirect()->to('/success');
        }

        $data['title'] = 'Create News';

        return view('templates/header', $data).view('news/create').view('templates/footer');
    }
}


