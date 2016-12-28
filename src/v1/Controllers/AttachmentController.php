<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\AttachmentRepository;

/**
 *  Attachment resource representation.
 *
 * @Resource("Attachment", uri="/attachments")
 */
class AttachmentController extends ResourceController
{
    protected $routeName = 'attachment';
    protected $repositoryClass = AttachmentRepository::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [];

}
