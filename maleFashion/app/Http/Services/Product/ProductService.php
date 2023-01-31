<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
    // Hàm lấy toàn bộ thông tin menu
    public function getMenu()
    {
        // return Menu::orderbyDesc('id')->paginate(20);
        return Menu::Where('active', 1)->get();
    }
    // Hàm xử lý việc thêm menu mới vào DB
    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active')
            ]);
            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    // Hàm xử lý việc xóa menu trong DB
    public function destroy($request){
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();

        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    // Hàm xử lý việc cập nhật thông tin mới vào DB
    public function update($request, $menu) : bool
    {
    // Làm nhanh
        // fill: Quét toàn bộ thông tin request đã lấy
        // $menu->fill($request->input());
        // $menu->save();
    // Làm thủ công
        if($request->input('parent_id') != $menu->id)
        {
            $menu->parent_id = (int) $request->input('parent_id');
        }
            $menu->name =(string) $request->input('name');
            $menu->description =(string) $request->input('description');
            $menu->content =(string) $request->input('content');
            $menu->active =(string) $request->input('active');
            $menu->save();
            Session::flash('success', 'Cập nhật thành công danh mục');
        return true;
    }
}
