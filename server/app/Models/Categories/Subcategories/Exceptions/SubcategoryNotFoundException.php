<?php

namespace App\Models\Categories\Subcategories\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubcategoryNotFoundException extends NotFoundHttpException
{

    /**
     * EmployeeNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('Employee not found.');
    }
}
