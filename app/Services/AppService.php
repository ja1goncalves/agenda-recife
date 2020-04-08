<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:47
 */

namespace App\Services;

use Carbon\Carbon;

/**
 * Class AppService
 * @package App\Services
 * @method create(array $all)
 * @method find(int $id)
 * @method all($get)
 * @method update(array $all, $id)
 * @method restore($id)
 * @method delete($id)
 * @method forceDelete(int $id)
 * @method findWhere(array $data)
 */
class AppService
{
    /**
     * @param array|object $data
     * @param string $message
     * @param int $status
     * @return array
     */
    protected function returnSuccess($data = [], string $message = 'Everything OK!', int $status = 200)
    {
        return [
            'data' => $data,
            'error' => false,
            'message' => $message,
            'status' => $status
        ];
    }

    /**
     * @param array|object $data
     * @param string $message
     * @param int $status
     * @return array
     */
    protected function returnError($data = [], string $message = 'Any error occurrence!', int $status = 500)
    {
        return [
            'data' => $data,
            'error' => true,
            'message' => $message,
            'status' => $status
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    protected function filters(array $data)
    {
        $filter = [];
        foreach ($data as $key => $item):
            if (!empty($item) && !is_null($item)):
                if (in_array($key, ['limit', 'page']))
                    $filter[$key] = $item;
                else if (Carbon::createFromFormat('d/m/Y', $item) !== false)
                    $filter[$key] = Carbon::createFromFormat('d/m/Y', $item)->format('Y-m-d');
                else if (in_array($key, ['name', 'email', 'artist', 'location', 'link', 'sale_link', 'route']))
                    $filter[] = [$key, 'like', "%{$item}%"];
                else
                    $filter[$key] = $item;
            endif;
        endforeach;
        return $filter;
    }
}
