<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Admin\Column\BaseColumn as Column;
use App\Admin\Form\BaseControl as Control;
use App\Admin\Filter\BaseFilter as Filter;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that using as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Admin module title
     *
     * @var string
     */
    public $moduleTitle = 'Пользователи';

    /**
     * Admin module plural words
     *
     * @var array
     */
    public $modulePluralWords = [
        'пользователь', 'пользователя', 'пользователей', 'пользователя'
    ];

    /**
     * Enable/disable massive delete items
     *
     * @var bool
     */
    public $massDeletable = false;

    /**
     * Users Types
     *
     * @var array
     */
    protected $types = [
        'user' => 'Пользователь',
        'admin' => 'Администратор',
    ];

    /**
     * Model attributes using for search in admin panel
     *
     * @var array
     */
    public $searchAttributes = [
        'id', 'name', 'last_name', 'email'
    ];

    /***********************************
     * RELATIONS
     ***********************************/


    /***********************************
     * MODEL HELPERS FUNCTIONS
     ***********************************/

    /**
     * Get user type name
     *
     * @return mixed
     */
    public function getType() {
        return $this->types[$this->role] ?? $this->types['user'];
    }

    /**
     * Get all user types
     *
     * @return array
     */
    public function getTypes() {
        return $this->types;
    }

    /**
     * Check user role
     *
     * @param $role
     * @return bool
     */
    public function isRole($role) {
        if (is_array($role)) {
            return in_array($this->role, $role);
        } else {
            return $this->role === $role;
        }
    }

    /**
     * Get All Last name and First name of Users
     * Using for JSON Objects
     *
     * @return array
     */
    public static function getAllUsers() {
        $out = [];
        $users = self::orderBy('id', 'asc')->get();
        foreach($users as $user) {
            $out[$user->id] = $user->last_name . ' ' . $user->name;
        }

        return $out;
    }

    public function getFullName()
    {
        return $this->last_name . ' '. $this->name;
    }

    /***********************************
     * ADMIN INITIALIZE FUNCTIONS
     ***********************************/

    /**
     * Initialize Admin List View
     */
    public function initializeAdminList() {
        $this->setAdminColumns([
            Column::custom('users.fio')->setTitle('ФИО')->sortable('name'),
            Column::text('email')->setTitle('E-mail адрес')->sortable(),
            Column::custom('users.type')->setTitle('Роль пользователя')->sortable('role'),
            Column::date('created_at')->setTitle('Дата создания')->sortable(),
        ]);

        $this->setAdminFilters([
            Filter::period('created_at'),
            Filter::select('role')->setTitle('Роль пользователя')->setValues($this->getTypes()),
        ]);
    }

    public function initializeAdminForm() {
        $this->setAdminFormControl([
            Control::text('last_name')->setTitle('Фамилия')->required(),
            Control::text('name')->setTitle('Имя')->required(),
            Control::email('email')->setTitle('E-mail адрес')->required(),
            Control::select('role', $this->getTypes())->setTitle('Роль пользователя')->required(),
            Control::password('password')->setTitle('Пароль', 'Новый пароль')->createRequired(),
        ]);
    }

    public function callbackAfterCreate(Request $request, BaseModel $item) {
        if ($item->password) {
            $item->password = \Hash::make($item->password);
            $item->save();
        }

        $locales = $request->get('user_locale', []);
        foreach ($locales as $key => $value) {
            \App\Models\UserLocale::create([
                'user_id' => $item->id,
                'locale_id' => $value,
            ]);
        }
    }

    public function callbackAfterEdit(Request $request, BaseModel $item) {
        \App\Models\UserLocale::where('user_id', '=', $item->id)->delete();

        $locales = $request->get('user_locale', []);
        foreach($locales as $locale) {
            \App\Models\UserLocale::create([
                'user_id' => $item->id,
                'locale_id' => $locale,
            ]);
        }
    }

}
