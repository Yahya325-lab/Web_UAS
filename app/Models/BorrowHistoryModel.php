<?php namespace App\Models;

use CodeIgniter\Model;



class BorrowHistoryModel extends Model
{
    protected $table = 'borrow_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'book_id', 'borrow_date', 'return_date', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'borrow_date';
    protected $updatedField  = 'return_date';
}
