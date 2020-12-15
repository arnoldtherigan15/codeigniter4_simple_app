<?php

namespace App\Controllers;

class Comic extends BaseController
{
    public function index()
    {
        $comics = $this->comicModel->getComic();

        $data = [
            "title" => "Comic Lists",
            "comics" => $comics
        ];
        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $comic = $this->comicModel->getComic($slug);
        // dd($comic);

        $data = [
            "title" => "Comic Detail",
            "comic" => $comic
        ];

        if (empty($data["comic"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic title ' . $slug . ' not found.');
        }
        return view('comics/detail', $data);
    }

    public function create()
    {
        $data = [
            "title" => "Add New Comic",
            "validation" => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    public function save()
    {
        // 'title' => 'required|is_unique[comics.title]'
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[comics.title]',
                'errors' => [
                    'required' => '{field} is required',
                    'is_unique' => 'This {field} is already been declared'
                ]
            ],
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'too large file size',
                    'is_image' => 'file is not an image',
                    'mime_in' => 'file is not an image '
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/Comic/create')->withInput()->with('validation', $validation);
            return redirect()->to('/Comic/create')->withInput();
        }

        $coverFile = $this->request->getFile('cover');
        if ($coverFile->getError() == 4) {
            $coverName = 'default.jpg';
        } else {
            $coverName = $coverFile->getRandomName();
            // pindahkan file ke folder img
            $coverFile->move('img', $coverName);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicModel->save([
            'cover' => $coverName,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
        ]);

        session()->setFlashdata('message', 'Successfully add new comic');

        return redirect()->to('/comic');
    }

    public function delete($id)
    {
        $comic = $this->comicModel->find($id);
        if ($comic['cover'] !== 'default.jpg') unlink('img/' . $comic['cover']);
        $this->comicModel->delete($id);
        return redirect()->to('/comic');
    }

    public function edit($slug)
    {
        $data = [
            "title" => "Edit Comic",
            "validation" => \Config\Services::validation(),
            "comic" => $this->comicModel->getComic($slug)
        ];
        return view('comics/edit', $data);
    }

    public function update($id)
    {
        $oldData = $this->comicModel->getComic($this->request->getVar('slug'));
        if ($oldData['title'] == $this->request->getVar('title')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[comics.title]';
        }
        if (!$this->validate([
            'title' => [
                'rules' => $rule_title,
                'errors' => [
                    'required' => '{field} is required',
                    'is_unique' => 'This {field} is already been declared'
                ]
            ],
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'too large file size',
                    'is_image' => 'file is not an image',
                    'mime_in' => 'file is not an image '
                ]
            ]
        ])) {

            return redirect()->to('/Comic/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $coverFile = $this->request->getFile('cover');
        if ($coverFile->getError() == 4) {
            $coverName = $this->request->getVar('coverOld');
        } else {
            $coverName = $coverFile->getRandomName();
            // pindahkan file ke folder img
            $coverFile->move('img', $coverName);
            unlink('img/' . $this->request->getVar('coverOld'));
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicModel->save([
            'id' => $id,
            'cover' => $coverName,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
        ]);

        session()->setFlashdata('message', 'Successfully edit comic data');

        return redirect()->to('/comic');
    }
    //--------------------------------------------------------------------

}
