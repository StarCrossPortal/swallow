<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class ProductsModel extends Model
{
    protected $name = 'products';


    public static function getCount($projectId)
    {
        $data = [];
        $cateList = Db::table('products')->whereNotIn('name', '')->group('name')->column('name');

        foreach ($cateList as $title) {
            $where = ['project_id' => $projectId];
            $data[$title] = Db::table('websites')->where($where)->whereLike('product', "%{$title}%")->cache(60)->count();
        }

        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByPort($projectId)
    {
        $data = [];
        $cateList = Db::table('products')->whereNotIn('name', '')->group('name')->column('name');

        foreach ($cateList as $title) {
            $where = ['project_id' => $projectId];
            $data[$title] = Db::table('ports')->where($where)->whereLike('product', "%{$title}%")->cache(60)->count();
        }

        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function updateCategory()
    {
        $list = Db::table('websites')->orderRand(1000)->select();
        $data = [];
        foreach ($list as $item) {
            $productCateArr = explode(',', $item['product_category']);
            $productArr = explode(',', $item['product']);
            foreach ($productArr as $key => $value) {
                $data[$value] = ['name' => $value, 'category' => $productCateArr[$key]];
            }
        }
        foreach ($data as $item) {
            Db::table('products')->where(['name' => $item['name']])->update($item);
        }
    }
}