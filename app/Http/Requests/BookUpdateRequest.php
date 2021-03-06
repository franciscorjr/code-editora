<?php

namespace CodePub\Http\Requests;


use CodePub\Repositories\BookRepository;

class BookUpdateRequest extends BookCreateRequest
{

    /**
     * @var BookRepository
     */
    private $repository;

    public function __construct(BookRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->method() == 'PUT'){

            $id = (int) $this->route('book');

            if ($id == 0){
                return false;
            }

            $book = $this->repository->find($id);

            return $book->author_id == \Auth::user()->id;

        }

        return true;
    }

}
