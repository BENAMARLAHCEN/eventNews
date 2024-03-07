<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\Interface\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{

    public function list(int $perPage = 10)
    {
        return Category::paginate($perPage);
    }

    public function findById($id)
    {
        //fetch single category
        return Category::find($id);
    }


    public function storeOrUpdate($data = [], $id = null)
    {
        //store or update the category
        if ($id) {
            $category = Category::find($id);
            $category->update($data);
            return $category;
        } else {
            return Category::create($data);
        }
    }

    public function destroyById($id)
    {
        //delete category
        $category = Category::find($id);
        return $category->delete();
    }
}
