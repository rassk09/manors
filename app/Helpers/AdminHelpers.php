<?php

function adminGetSidebarLink(array $sidebar_item) {
    if (isset($sidebar_item['route'])) {
        return route($sidebar_item['route'], $sidebar_item['route_attribute'] ?? null);
    }

    return 'javascript:;';
}

function adminApplyQueryFilters($query, array $filter)
{
    foreach ($filter as $key => $value){
        if (!is_array($value)){
            $value = [$value];
        }
        if (!is_numeric($key)){
            array_unshift($value, $key);
        }
        call_user_func_array([$query, 'where'], $value);
    }
}

function adminGetBreadcrumbs($array, $moduleName, &$result = []) {
    $result = [];
    if (is_array($array)) {
        foreach ($array as $node) {
            if (isset($node['route_attribute']) && $node['route_attribute']['module'] == $moduleName) {
                $result[] = $node['title'];
                return $result;
            } else if (!empty($node['items'])) {
                if (adminGetBreadcrumbs($node['items'], $moduleName, $result)){
                    $result[] = $node['title'];
                    return $result;
                }
            }
        }
    } else {
        if ($array == $moduleName) {
            $result[] = $array;
            return $result;
        }
    }
    return false;
}

function adminGetDirectionByOrder($attribute) {
    $request = request();
    if (!$request->order) {
        return '&dir=asc';
    } else {
        if ($request->order == $attribute) {
            return ($request->dir == 'asc') ? '&dir=desc' : '&dir=asc';
        } else {
            return '&dir=asc';
        }
    }
}

function adminGetDirectionIconByOrder($attribute) {
    $request = request();
    if (!$request->order && $attribute == 'id') {
        return '-down';
    } else {
        if ($request->order == $attribute) {
            return ($request->dir == 'asc') ? '-down' : '-up';
        } else {
            return '';
        }
    }
}

function adminIsActiveMenuItem($sidebar) {
    if (($sidebar['route'] ?? null) == 'admin_module_index') {
        if (request('module') == ($sidebar['route_attribute']['module'] ?? null)) {
            return true;
        }
    } else if (strpos(($sidebar['route'] ?? null), 'admin_translation') === 0) {
        if (strpos(\Route::currentRouteName(), 'admin_translation') === 0) {
            return true;
        }
    } else {
        if (\Route::currentRouteName() == ($sidebar['route'] ?? null)) {
            return true;
        }
    }

    if (isset($sidebar['items'])) {
        $active = false;
        foreach($sidebar['items'] as $item) {
            if (adminIsActiveMenuItem($item)) {
                $active = true;
            }
        }

        return $active;
    }
}

function adminGetBadge($badge) {
    if ($badge) {
        $function = $badge['value'];
        $value = $function();
        if ($value > 0) {
            return '<span class="label label-' . $badge['color'] . ' m-l-5">' . $value . '</span>';
        }
    }

    return '';
}

function adminBadgeEventsModeration() {
    return \App\Models\Event::whereNotIn('status_id', [-1, 5, 6])->count();
}