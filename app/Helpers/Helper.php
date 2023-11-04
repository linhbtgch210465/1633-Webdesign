<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a  class="btn btn-danger btn-sm" href="/admin/menus/destroy/' . $menu->id . '">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '--');

            }

        }

        return $html;

    }

    public static function menus($menus): string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if (count($menu['child'])) {

                $html .= "<li>" . $menu["name"] .
                    "<ul class='sub-menu'>";
                foreach ($menu['child'] as $menuSub1) {

                    if (count($menuSub1['child'])) {
                        $html .= "<li>" . $menuSub1["name"] .
                            "<ul class='sub-menu'>";
                        foreach ($menuSub1['child'] as $menuSub2) {
                            $html .= '<li>' . $menuSub2['name'] . '</li>';
                        }
                        $html .= "</li></ul>";
                    } else {
                        $html .= '<li>' . $menuSub1['name'] . '</li>';
                    }
                }
                $html .= "</li></ul>";
            } else {
                $html .= '<li>
                        <a href="/category/' . $menu['id'] .Str::slug($menu['name'], '-') . '.htm ">
                            ' . $menu['name'] . '
                        </a>
                        </li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id): bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }
    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) {
            return number_format($priceSale);
        }

        if ($price != 0) {
            return number_format($price);
        }

        return '<a href="/contact.html">Contact</a>';
    }

    public function data_tree_array($data, $parent_id = 0)
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
