<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $adminRole = null;
    private $userRole = null;
    private $subFolder = '';

    public function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null){
        $href = $this->subFolder . $href;
        if($this->dropdown === false){
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if(empty($permission)){
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if(in_array('user', $roles)){
            $this->userRole->givePermissionTo($permission);
        }
        if(in_array('admin', $roles)){
            $this->adminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name){
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        /* Get roles */
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->userRole = Role::where('name', '=', 'user' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('admin', 'Dashboard', '/', 'cil-speedometer');
        $this->insertLink('admin', 'Clients', '/client', 'cil-speedometer');
        $this->insertLink('admin', 'Projects', '/project', 'cil-speedometer');
        //     $this->insertLink('user,admin', 'Buttons',           '/buttons/buttons');
        //     $this->insertLink('user,admin', 'Buttons Group',     '/buttons/button-group');
        //     $this->insertLink('user,admin', 'Dropdowns',         '/buttons/dropdowns');
        //     $this->insertLink('user,admin', 'Brand Buttons',     '/buttons/brand-buttons');
        // $this->endDropdown();
        // // $this->insertLink('user,admin', 'Charts', '/charts', 'cil-chart-pie');
        // // $this->beginDropdown('user,admin', 'Icons', 'cil-star');
        // //     $this->insertLink('user,admin', 'CoreUI Icons',      '/icon/coreui-icons');
        // //     $this->insertLink('user,admin', 'Flags',             '/icon/flags');
        // //     $this->insertLink('user,admin', 'Brands',            '/icon/brands');
        // // $this->endDropdown();
        // // $this->beginDropdown('user,admin', 'Notifications', 'cil-bell');
        // //     $this->insertLink('user,admin', 'Alerts',     '/notifications/alerts');
        // //     $this->insertLink('user,admin', 'Badge',      '/notifications/badge');
        // //     $this->insertLink('user,admin', 'Modals',     '/notifications/modals');
        // // $this->endDropdown();
        // // $this->insertLink('user,admin', 'Widgets', '/widgets', 'cil-calculator');
        // // $this->beginDropdown('user,admin', 'Pages', 'cil-star');
        // //     $this->insertLink('user,admin', 'Login',         '/login');
        // //     $this->insertLink('user,admin', 'Register',      '/register');
        // //     $this->insertLink('user,admin', 'Error 404',     '/404');
        // //     $this->insertLink('user,admin', 'Error 500',     '/500');
        // // $this->endDropdown();

        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $id = $this->beginDropdown('admin', 'Settings');
        $id = $this->insertLink('admin', 'Edit roles',              '/roles');
        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
