<?php
namespace App\admin;
use Illuminate\Database\Eloquent\Model;
class Users extends Model
{
    protected $pk = 'id';
    protected $table = 'users';
    public $timestamps = false;
}