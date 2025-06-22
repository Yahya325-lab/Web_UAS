<?php namespace App\Controllers;


use App\Models\BookModel;
use App\Models\BorrowHistoryModel;

class UserController extends BaseController {

    public function index() {
        $model = new BookModel();
        $keyword = $this->request->getGet('q');

        if ($keyword) {
            $data['books'] = $model->like('title', $keyword)->findAll();
        } else {
            $data['books'] = $model->findAll();
        }

        $data['q'] = $keyword; 
        echo view('user/book_list', $data);
    }




    public function detail($id) {
    $model = new BookModel();

    $book = $model->find($id); // Tanpa filter user_id

    if (!$book) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan');
    }

    $data['book'] = $book;
    return view('user/book_detail', $data);
}



    public function borrow($book_id) {
        $bookModel = new BookModel();
        $borrowModel = new BorrowHistoryModel();

        $book = $bookModel->find($book_id);
        if (!$book) {
            return redirect()->to('/user')->with('error', 'Buku tidak ditemukan');
        }
        if ($book['status'] == 'borrowed') {
            return redirect()->to('/user')->with('error', 'Buku sedang dipinjam');
        }

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu');
        }

        $bookModel->update($book_id, ['status' => 'borrowed']);
        $borrowModel->save([
            'user_id'     => $user_id,
            'book_id'     => $book_id,
            'borrow_date' => date('Y-m-d H:i:s'),
            'return_date' => null,
        ]);


        return redirect()->to('/user')->with('success', 'Buku berhasil dipinjam');
    }
    public function borrowHistory() {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu');
        }

        $borrowModel = new BorrowHistoryModel();
        $bookModel = new BookModel();

        $data['history'] = $borrowModel
            ->select('borrow_history.*, books.title')
            ->join('books', 'books.id = borrow_history.book_id')
            ->where('borrow_history.user_id', $user_id)
            ->orderBy('borrow_date', 'DESC')
            ->findAll();

        echo view('user/borrow_history', $data);
    }
    public function __construct()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'user') {
            redirect()->to('/login')->send();
            exit;
        }
    }
    public function returnBook($borrow_id)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu');
        }

        $borrowModel = new \App\Models\BorrowHistoryModel();
        $bookModel = new \App\Models\BookModel();

        $borrow = $borrowModel->find($borrow_id);

        if (!$borrow || $borrow['user_id'] != $user_id || $borrow['return_date'] !== null) {
            return redirect()->to('/user/history')->with('error', 'Data tidak valid');
        }

        // Update return_date
        $borrowModel->update($borrow_id, [
            'return_date' => date('Y-m-d H:i:s')
        ]);

        // Update status buku jadi tersedia kembali
        $bookModel->update($borrow['book_id'], [
            'status' => 'available'
        ]);

        return redirect()->to('/user/history')->with('success', 'Buku berhasil dikembalikan');
    }
    public function borrowedBooks() {
    $user_id = session()->get('user_id');
    if (!$user_id) {
        return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu');
    }

    $borrowModel = new BorrowHistoryModel();

    $data['books'] = $borrowModel
        ->select('books.*, borrow_history.id as borrow_id, borrow_history.borrow_date')
        ->join('books', 'books.id = borrow_history.book_id')
        ->where('borrow_history.user_id', $user_id)
        ->where('borrow_history.return_date', null)
        ->findAll();

    return view('user/borrowed_books', $data);
}




}
