<?php

namespace mdm\admin\components;

use Yii;
use yii\web\User;
use yii\helpers\ArrayHelper;
use yii\caching\TagDependency;

/**
 * Description of Helper
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 2.3
 */
class Helper
{
    private static $_userRoutes = [];
    private static $_defaultRoutes;
    private static $_routes;

    public static function getRegisteredRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            $manager = Configs::authManager();
            foreach ($manager->getPermissions() as $item) {
                if ($item->name[0] === '/') {
                    self::$_routes[$item->name] = $item->name;
                }
            }
        }
        return self::$_routes;
    }

    /**
     * Get assigned routes by default roles
     * @return array
     */
    protected static function getDefaultRoutes()
    {
        if (self::$_defaultRoutes === null) {
            $manager = Configs::authManager();
            $roles = $manager->defaultRoles;
            $cache = Configs::cache();
            if ($cache && ($routes = $cache->get($roles)) !== false) {
                self::$_defaultRoutes = $routes;
            } else {
                $permissions = self::$_defaultRoutes = [];
                foreach ($roles as $role) {
                    $permissions = array_merge($permissions, $manager->getPermissionsByRole($role));
                }
                foreach ($permissions as $item) {
                    if ($item->name[0] === '/') {
                        self::$_defaultRoutes[$item->name] = true;
                    }
                }
                if ($cache) {
                    $cache->set($roles, self::$_defaultRoutes, Configs::cacheDuration(), new TagDependency([
                        'tags' => Configs::CACHE_TAG
                    ]));
                }
            }
        }
        return self::$_defaultRoutes;
    }

    /**
     * Get assigned routes of user.
     * @param integer $userId
     * @return array
     */
    public static function getRoutesByUser($userId)
    {
        if (!isset(self::$_userRoutes[$userId])) {
            $cache = Configs::cache();
            if ($cache && ($routes = $cache->get([__METHOD__, $userId])) !== false) {
                self::$_userRoutes[$userId] = $routes;
            } else {
                $routes = static::getDefaultRoutes();
                $manager = Configs::authManager();
                foreach ($manager->getPermissionsByUser($userId) as $item) {
                    if ($item->name[0] === '/') {
                        $routes[$item->name] = true;
                    }
                }
                self::$_userRoutes[$userId] = $routes;
                if ($cache) {
                    $cache->set([__METHOD__, $userId], $routes, Configs::cacheDuration(), new TagDependency([
                        'tags' => Configs::CACHE_TAG
                    ]));
                }
            }
        }
        return self::$_userRoutes[$userId];
    }

    /**
     * Check access route for user.
     * @param string|array $route
     * @param integer|User $user
     * @return boolean
     */
    public static function checkRoute($route, $params = [], $user = null)
    {
        $config = Configs::instance();
        $r = static::normalizeRoute($route);
        if ($config->onlyRegisteredRoute && !isset(static::getRegisteredRoutes()[$r])) {
            return true;
        }

        if ($user === null) {
            $user = Yii::$app->getUser();
        }
        $userId = $user instanceof User ? $user->getId() : $user;

        if ($config->strict) {
            if ($user->can($r, $params)) {
                return true;
            }
            while (($pos = strrpos($r, '/')) > 0) {
                $r = substr($r, 0, $pos);
                if ($user->can($r . '/*', $params)) {
                    return true;
                }
            }
            return $user->can('/*', $params);
        } else {
            $routes = static::getRoutesByUser($userId);
            if (isset($routes[$r])) {
                return true;
            }
            while (($pos = strrpos($r, '/')) > 0) {
                $r = substr($r, 0, $pos);
                if (isset($routes[$r . '/*'])) {
                    return true;
                }
            }
            return isset($routes['/*']);
        }
    }

    protected static function normalizeRoute($route)
    {
        if ($route === '') {
            return '/' . Yii::$app->controller->getRoute();
        } elseif (strncmp($route, '/', 1) === 0) {
            return $route;
        } elseif (strpos($route, '/') === false) {
            return '/' . Yii::$app->controller->getUniqueId() . '/' . $route;
        } elseif (($mid = Yii::$app->controller->module->getUniqueId()) !== '') {
            return '/' . $mid . '/' . $route;
        }
        return '/' . $route;
    }

    /**
     * Filter menu items
     * @param array $items
     * @param integer|User $user
     */
    public static function filter($items, $user = null)
    {
        if ($user === null) {
            $user = Yii::$app->getUser();
        }
        return static::filterRecursive($items, $user);
    }

    /**
     * Filter menu recursive
     * @param array $items
     * @param integer|User $user
     * @return array
     */
    protected static function filterRecursive($items, $user)
    {
        $result = [];
        foreach ($items as $i => $item) {
            $url = ArrayHelper::getValue($item, 'url', '#');
            $allow = is_array($url) ? static::checkRoute($url[0], array_slice($url, 1), $user) : true;

            if (isset($item['items']) && is_array($item['items'])) {
                $subItems = self::filterRecursive($item['items'], $user);
                if (count($subItems)) {
                    $allow = true;
                }
                $item['items'] = $subItems;
            }
            if ($allow) {
                $result[$i] = $item;
            }
        }
        return $result;
    }

    /**
     * Filter action column button. Use with [[yii\grid\GridView]]
     * ```php
     * 'columns' => [
     *     ...
     *     [
     *         'class' => 'yii\grid\ActionColumn',
     *         'template' => Helper::filterActionColumn(['view','update','activate'])
     *     ]
     * ],
     * ```
     * @param array|string $buttons
     * @param integer|User $user
     * @return string
     */
    public static function filterActionColumn($buttons = [], $user = null)
    {
        if (is_array($buttons)) {
            $result = [];
            foreach ($buttons as $button) {
                if (static::checkRoute($button, [], $user)) {
                    $result[] = "{{$button}}";
                }
            }
            return implode(' ', $result);
        }
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use ($user) {
            return static::checkRoute($matches[1], [], $user) ? "{{$matches[1]}}" : '';
        }, $buttons);
    }

    /**
     * Use to invalidate cache.
     */
    public static function invalidate()
    {
        if (Configs::cache() !== null) {
            TagDependency::invalidate(Configs::cache(), Configs::CACHE_TAG);
        }
    }

    /**
     * [access 获取当前用户所有权限 / 是否拥有权限]
     * @return [type] [权限一维数组 ／ Booleans]
     */
    public static function access($route = null){
        //获取当前用户id
        $user_id = Yii::$app->user->getId();
        
        //获取用户第一级权限（user-role）
        $role = Yii::$app->db->createCommand('SELECT item_name FROM mly_auth_assignment WHERE user_id ='.$user_id)->queryAll();

        //获取用户第二级权限(role-promission)
        $promission = [];
        $num = 0;
        foreach ($role as $key => $value) {
            $promission[$num] = Yii::$app->db->createCommand("SELECT * FROM mly_auth_item_child WHERE parent ='".$value['item_name']."'")->queryAll();
            $num++;
        }

        // p($promission);die;
        // 合并上述多个数组--二级数组
        $num = 0;
        $new_promission = [];
        foreach ($promission as $key => $value) {
            foreach ($value as $k => $v) {
                $new_promission[$num] = $v['child'];
                $num++;
            }
        }

        // p($new_promission);die;
        //获取用户第三级权限(promission-action)
        $action = [];
        $num = 0;
        foreach ($promission as $key => $value) {
            foreach ($value as $k => $v) {
                $action[$num] = Yii::$app->db->createCommand("SELECT * FROM mly_auth_item_child WHERE parent ='".$v['child']."'")->queryAll();
                $num++;
            }
        }

        // 处理三级权限
        $action = array_filter($action);
        $new_action = [];
        $num = 0;
        foreach ($action as $key => $value) {
            foreach ($value as $k => $v) {
                $new_action[$num] = $v['child'];
                $num++;
            }
        }
        
        //获取全部权限数组 二三级权限数组合并
        $access = array_merge($new_action,$new_promission);
        if($route !== null){
            // p($route);die;
            $route_array = explode('/',$route);
            if(in_array('/*', $access) || in_array('/'.$route_array[1].'/*',$access) || in_array($route,$access)){
                return true;
            }
        }else{
            return $access;
        }
    }

    public static function role(){
        //获取当前用户id
        $user_id = Yii::$app->user->getId();

        //获取用户第一级权限（user-role）
        $role = Yii::$app->db->createCommand('SELECT item_name FROM mly_auth_assignment WHERE user_id ='.$user_id)->queryAll();

        return $role;
    }
}