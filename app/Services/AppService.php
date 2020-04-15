<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:47
 */

namespace App\Services;

use App\Model\AppModel;
use Carbon\Carbon;

/**
 * Class AppService
 * @package App\Services
 * @method find(int $id)
 * @method restore($id)
 * @method forceDelete(int $id)
 */
class AppService
{
    /**
     * @var AppModel
     */
    protected $model;

    /**
     * @param array|object $data
     * @param string $message
     * @param int $status
     * @return array
     */
    protected function returnSuccess($data = [], string $message = 'Everything OK!', int $status = 200)
    {
        return [
            'data' => is_array($data) ? $this->setValueNull($data) : $data,
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
            'data' => is_array($data) ? $this->setValueNull($data) : $data,
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
                else if (in_array($key, ['name', 'email', 'artist', 'location', 'link', 'sale_link', 'route']))
                    $filter[] = [$key, 'like', "%{$item}%"];
                else if (Carbon::createFromFormat('d/m/Y', $item) !== false)
                    $filter[$key] = Carbon::createFromFormat('d/m/Y', $item)->format('Y-m-d');
                else
                    $filter[$key] = $item;
            endif;
        endforeach;
        return $filter;
    }

    /**
     * @param array $data
     * @return array
     */
    public function all(array $data)
    {
        try {
            if (isset($data['id'])):
                $model = $this->model->getById((int)$data['id']);
            else:
                $filters = $this->filters($data);
                $model = $this->model->findWhere($filters)
                    ->orderBy('created_at', 'DESC')
                    ->paginate($filters['limit'] ?? 10);
            endif;

            return $this->returnSuccess($model->toArray());
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        try {
            return $this->returnSuccess($this->model->add($data)->toArray());
        } catch (\Exception $e) {
            return $this->returnError(['name' => $data['name']], $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return array
     */
    public function update(array $data, $id)
    {
        try {
            unset($data['_token']);
            return $this->returnSuccess($this->model->edit($id, $data)->toArray());
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        try {
            return $this->returnSuccess($this->model->remove($id));
        } catch (\Exception $e) {
            return $this->returnError([], $e->getMessage());
        }
    }

    protected function setValueNull($data = [])
    {
        $return = [];
        if (is_bool($data) || $data === 0) return $data;
        if (is_null($data)) return '';

        if (!empty($data)):
            if (is_array($data) || is_object($data)):
                foreach ($data as $key => $item) :
                    $return[$key] = $this->setValueNull($item);
                endforeach;
            else:
                return is_null($data) ? '' : $data;
            endif;
        endif;

        return $return;
    }
}
