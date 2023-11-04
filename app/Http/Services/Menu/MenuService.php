<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function show($id)
    {
        return Menu::with('products')->select('name', 'id')->find($id);
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),

            ]);

            Session::flash('success', 'Created category successfull');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $menu)
    {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }

        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->save();

        Session::flash('success', 'Update category successfull');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $request->input('id'))->first();

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb');

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
    public function all($nested = false)
    {

        $menu = Menu::all();
        if ($nested) {
            return $this->data_tree_array($menu);
        }
        return $menu;
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


