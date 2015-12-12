<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/7/15
 * Time: 5:21 PM
 */

namespace Md\Repos\Category;

use Md\Category;


class CategoryRepository
{
    /**
     * This category model instance
     * @var \Md\Category
     */
    private $category;

    /**
     * Constructor initializer for this class
     * @param Category $categoryModel
     */

    public function __construct(Category $categoryModel)
    {
        $this->category = $categoryModel;
    }

    /**
     * Gets all the categories of innovations possible
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     */
    public function getAllCategories()
    {
        return $this->category->all();
    }

} 