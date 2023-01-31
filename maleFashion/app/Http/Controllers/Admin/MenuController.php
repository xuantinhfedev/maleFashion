<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class MenuController extends Controller
{

    // Khai báo service
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    // Hàm tạo menu
    public function create(){

        return view('admin.menu.add',[
            'title' => 'Thêm danh mục mới',
            'menus' => $this->menuService->getParent()
        ]);
    }
    // Hàm lưu trữ menu
    public function store(CreateFormRequest $request){
        $this->menuService->create($request);

        return redirect()->back();
    }
    // Hàm hiển thị danh sách menu
    public function index(){

        return view('admin.menu.list', [
            'title' => 'Danh sách danh mục mới nhất',
            'menus' => $this->menuService->getAll()
        ]);
    }
    // Hàm xóa menu
    public function destroy(Request $request){
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa danh mục thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
    // Hàm show view menu edit
    public function show(Menu $menu){
        // dd($menu);
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa danh mục: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }
    // Hàm cập nhật menu
    public function update(Menu $menu, CreateFormRequest $request){
        $this->menuService->update($request, $menu);

        return redirect('/admin/menus/list');
    }
}
