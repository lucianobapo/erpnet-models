<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PostRepository;
use ErpNET\Models\v1\Validators\PostValidator;

/**
 * Post resource representation.
 *
 * @Resource("Post", uri="/post")
 */
class PostController extends ResourceController
{
    protected $routeName = 'post';
    protected $repositoryClass = PostRepository::class;
    protected $validatorClass = PostValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
//        Criteria::class,
    ];
}
