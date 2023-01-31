<?php

namespace App\Helpers;

class Helper{
    // Hàm render body bảng html theo đệ quy
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if($menu->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td style="text-align: center">'.$menu->id.'</td>
                    <td>' . $char.$menu->name . '</td>
                    <td style="text-align: center">' . self::active($menu->active) . '</td>
                    <td>' . $menu->updated_at . '</td>
                    <td style="text-align: center">
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$menu->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow('.$menu->id.', \'/admin/menus/destroy\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                ';
                unset($menu[$key]);
                $html .= self::menu($menus, $menu->id, $char .'-- ');
            }
        }
        return $html;
    }

    // Hàm chỉnh sửa nút active
    public static function active($active = 0){
        return $active == 0 ? '<span class="btn btn-danger btn-sm">No</span>' : '<span class="btn btn-success btn-sm">Yes</span>';
    }
}
