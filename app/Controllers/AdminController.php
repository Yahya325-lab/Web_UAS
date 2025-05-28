<?php namespace App\Controllers;

use App\Models\BookModel;

class AdminController extends BaseController {

    public function index() {
        $model = new BookModel();
        $data['books'] = $model->findAll();
        echo view('admin/book_list', $data);
    }

    public function create() {
        echo view('admin/book_create');
    }

    public function store() {
        $model = new BookModel();

        $file = $this->request->getFile('image');
        $imageName = '';
        if ($file && $file->isValid()) {
            $imageName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $imageName);
        }

        $model->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'year' => $this->request->getPost('year'),
            'publisher' => $this->request->getPost('publisher'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin');
    }
    public function toggleStatus($id) {
        $model = new BookModel();
        $book = $model->find($id);
        if (!$book) {
            return redirect()->to('/admin')->with('error', 'Buku tidak ditemukan');
        }

        $newStatus = ($book['status'] === 'available') ? 'borrowed' : 'available';
        $model->update($id, ['status' => $newStatus]);

        return redirect()->to('/admin')->with('success', 'Status buku berhasil diubah');
    }
    public function __construct()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            redirect()->to('/login')->send();
            exit;
        }
    }
    public function delete($id)
    {
        $bookModel = new \App\Models\BookModel();

        // Cek apakah buku ada
        $book = $bookModel->find($id);
        if (!$book) {
            return redirect()->to('/admin')->with('error', 'Buku tidak ditemukan');
        }

        // Hapus gambar dari server
        $imagePath = WRITEPATH . 'uploads/' . $book['image'];
        if (is_file($imagePath)) {
            unlink($imagePath);
        }

        // Hapus buku dari database
        $bookModel->delete($id);

        return redirect()->to('/admin')->with('success', 'Buku berhasil dihapus');
    }


}
