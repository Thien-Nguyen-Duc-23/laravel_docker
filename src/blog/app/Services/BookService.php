<?php
namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Http\Requests\Admin\UpdateBookRequest;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Helpers\AdminHelper;

class BookService
{
    protected $book;
    
    // inject BookRepositoryInterface in construct
    public function __construct(BookRepositoryInterface $books)
    {
        $this->book = $books;
    }
    
    // get all category
    public function getCategory()
    {
        return Category::all();
    }

    // get information book need update
    public function editBook($id)
    {
        $result = $this->book->find($id);

        return $result;
    }

    // take all category and except category of book
    public function getAllCate($id)
    {
        $result = Category::where('id', '<>', $id)->get();

        return $result;
    }

    // function update book
    public function updateBook($id, UpdateBookRequest $request)
    {
        $folder = 'public/admin/books/';
        $colum = 'conver';

        $attributes = [
            'title' => $request->titleBook,
            'isbn' => $request->isbn,
            'author' => $request->authorBook,
            'discription' => $request->descriptionBook,
            'content' => $request->contentBook,
            'status' => config('define.active'),
            'slug' => str_slug($request->titleBook),
            'publisher_id' => config('define.user'),
            'category_id' => $request->categoryId,
        ];

        if ($request->file('coverImage') == null) {
            $result = $this->book->update($id, $attributes);
        } else {
            $fileUpload = $request->file('coverImage');
            $oldFile = $request->oldFile;
            
            $result = $this->book->updateUpload($id, $attributes, $fileUpload, $folder, $colum, $oldFile, null);
        }

        return $result;
    }


    public function getAllBook()
    {
        return $this->book->getAll();
    }
    
    // function store Book
    public function storeBook(StoreBookRequest $request)
    {
        $fileUpload = $request->file('coverImage');
        $folder = 'public/admin/books/';
        $colum = 'conver';
        
        $attributes = [
            'title' => $request->titleBook,
            'isbn' => $request->isbn,
            'author' => $request->authorBook,
            'discription' => $request->descriptionBook,
            'content' => $request->contentBook,
            'status' => config('define.active'),
            'slug' => str_slug($request->titleBook),
            'publisher_id' => config('define.user'),
            'category_id' => $request->categoryId,
        ];

        $result = $this->book->createUpload($attributes, $fileUpload, $folder, $colum, null);

        return $result;
    }

    // function delete book
    public function deleteBook($id)
    {
        $folder = 'public/admin/books/';
        $oldFile = $this->book->find($id)->conver;
        
        AdminHelper::deleteFile($folder, $oldFile);
        
        return $this->book->find($id)->delete();
    }

    // function search title or author
    public function search($value)
    {
        $result = Book::where('title', 'like', '%' . $value . '%')
            ->orWhere('author', 'like', '%' . $value . '%')
            ->get();

        return $result;
    }

    // function search title or author
    public function paginate($value)
    {
        \Session::put('valueSearch', $value);
        
        $result = Book::where('title', 'like', '%' . $value . '%')
            ->orWhere('author', 'like', '%' . $value . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(config('define.paginate'));

        return $result;
    }
    
    // function show detail book
    public function show($id)
    {
        return $this->book->find($id);
    }

    // function find slug
    public function findSlug($slug)
    {
        return $this->book->findSlug($slug)->first();
    }

    // funciton sort by comment, rating, latest
    public function sort(Request $request)
    {
        if ($request->orderby == 'comment') {
            $books = $this->book->getSortByComment();
        } elseif ($request->orderby == 'rating') {
            $books = $this->book->getSortByRate();
        } else {
            $books = $this->book->getBookPaginate();
        }

        return $books;
    }

    // function accept book
    public function acceptBook(Request $request)
    {
        $id = $request->id;
        $checkStatus = $this->book->find($id);

        if ($checkStatus->status == config('define.active')) {
            $attributes = [
                'status' => config('define.disable'),
            ];
        } else {
            $attributes = [
                'status' => config('define.active'),
            ];
        }
        
        $result = $this->book->update($id, $attributes);

        return $result;
    }
}
