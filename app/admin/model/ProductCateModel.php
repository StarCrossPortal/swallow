<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class ProductCateModel extends Model
{
    protected $name = 'product_categorys';


    public static function getCount($projectId)
    {
        $data = [];
//        $cateList = Db::table('product_categorys')->whereNotIn('name', '')->group('name')->cache()->column('name');
        $cateList = [];

        foreach ($cateList as $cate) {

            $where = ['project_id' => $projectId];
            $productList = Db::table('products')->where(['category' => $cate])->cache()->column('name');
            $appList = [];
            foreach ($productList as $product) {
                $appList[$product] = Db::table('websites')->where($where)->whereLike('product', "%{$product}%")->cache(60)->count();
            }
            arsort($appList);
            $appList = array_filter($appList);
            $data[] = ["name" => $cate, "lists" => $appList];
        }



        return $data;
    }
}