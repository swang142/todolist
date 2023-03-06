<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Filters\Filterable;

class Task extends Model
{
    use HasFactory, AsSource, Filterable;

    /**
     * @var array
     */
    protected $guarded = [];


}