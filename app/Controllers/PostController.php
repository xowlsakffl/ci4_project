<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;
use CodeIgniter\API\ResponseTrait;

class PostController extends BaseController
{
    use ResponseTrait;
    
    public $posts;

    public function __construct()
    {
        $this->posts = model(Post::class);
    }

    public function index()
    {
        $searchData = $this->request->getGet('searchData');

        if($searchData){
            $pagenateData = $this->posts->select('*')
            ->orLike('title', $searchData)
            ->orLike('body', $searchData)
            ->orLike('slug', $searchData)
            ->paginate(5);
        }else{
            $pagenateData = $this->posts->paginate(10);
        }

        $data = [
            'posts' => $pagenateData,
            'pager' => $this->posts->pager,
            'title' => 'Posts',
        ];

        return view('posts/list', $data);
    }

    public function store()
    {
        $rule = [
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required',
        ];

        if($this->validate($rule)){
            $data = [
                'title' => $this->request->getPost('title'),
                'body' => $this->request->getPost('body'),
                'slug' => url_title($this->request->getPost('slug'), '-', true),
            ];

            $this->posts->save($data);
            $data = [
                'code' => 200,
                'message' => 'Success!',
            ];

            return $this->respond($data);
        }else{
            $data = [
                'code' => 400,
                'message' => 'Invalid request.',
            ];
            return $this->failValidationErrors($data);
        }
    }

    public function view($id)
    {
        $data = [
            'post' => $this->posts->getPost($id),
        ];

        return view('posts/view', $data);
    }

    public function update($id)
    {
        if($this->request->getMethod() == 'put'){
            $rule = [
                'title' => 'required',
                'body' => 'required',
                'slug' => 'required',
            ];
    
            if($this->validate($rule)){
                $data = $this->request->getRawInput();
                $this->posts->update($id, $data);
                $data = [
                    'code' => 200,
                    'message' => 'Success!',
                ];
    
                return $this->respond($data);
            }else{
                $data = [
                    'code' => 400,
                    'message' => 'Invalid request.',
                ];
                return $this->failValidationErrors($data);
            }
        }else{
            $data = [
                'code' => 400,
                'message' => 'Invalid request.',
            ];
            return $this->fail($data);
        }
    }

    public function delete($id)
    {
        if($this->request->getMethod() == 'delete'){

                $this->posts->where('id', $id)->delete();
                $data = [
                    'code' => 200,
                    'message' => 'Success!',
                ];
    
                return $this->respondDeleted($data);
        }else{
            $data = [
                'code' => 400,
                'message' => 'Invalid request.',
            ];
            return $this->fail($data);
        }
    }

/*     public function search()
    {
        $searchData = $this->request->getGet();

        $db = \Config\Database::connect();
        $builder = $db->table('posts');
        
        $sql = $builder->like('title', $searchData['searchText'])->select('*')->limit(10)->get();
        $data = $sql->getResult();

        return $this->respond($data);
    } */
}
