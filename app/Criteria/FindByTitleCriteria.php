<?php

namespace CodePub\Criteria;

use CodePub\Repositories\BookRepository;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByTitleCriteria.
 *
 * @package namespace CodePub\Criteria;
 */
class FindByTitleCriteria implements CriteriaInterface
{

    /**
     * @var BookRepository
     */
    private $title;

    public function __construct($title)
    {

        $this->title = $title;
    }


    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('title', 'LIKE' , "%$this->title%");
    }
}
