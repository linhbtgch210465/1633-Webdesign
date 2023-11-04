<?php


namespace App\Http\View\Composers;
use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menus = Menu::select('id', 'name', 'parent_id')
        // ->where('ative', 1)
        ->orderByDesc('id')
        ->get();
       $menus = $this->data_tree_array($menus,0);
        $view->with('menus', $menus);
    }

    function data_tree_array($data, $parent_id = 0)
    {
        $result = [];
        foreach ($data as $item) {
            $bool = isset($item['parent_id'])
            ? $item['parent_id'] == $parent_id
            : $item['parent'] == $parent_id;
            if ($bool) {
                $child = $this->data_tree_array($data, $item['id']);
                $result[] = array_merge($item->toArray(), ['child' => $child]);
            }
        }
        return $result;
    }

}
