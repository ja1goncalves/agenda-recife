<?php


namespace App\Model;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppModel extends Model
{
    use SoftDeletes;

    public function listAll($limit = 10, $order_by = 'created_at')
    {
        return self::query()->orderBy($order_by, 'DESC')->paginate($limit);
    }

    public function getById(int $id)
    {
        return self::find($id);
    }

    public function add(Array $data)
    {
        return self::create($data);
    }

    public function edit($id, array $data)
    {
        $model = $this->getById($id);
        foreach($data as $key => $item):
            if(in_array($key, $this->fillable))
                $model->{$key} = $item;
        endforeach;
        $model->save();
        return $model;
    }

    public function remove($id)
    {
        $model = $this->getById($id);
        return $model->delete();
    }

    public function findByField($field, $value, $order_by = 'created_at', $select = [])
    {
        $query = self::query()->where($field, '=', $value)->orderBy($order_by, 'DESC');
        return empty($select) ? $query->get($select) : $query;
    }

    public function findWhere(array $wheres, $finish = false, $columns = ['*'])
    {
        $query = self::query();
        foreach ($wheres as $key => $value):
            if (is_array($value) && count($value) >= 3):
                $query->where($value[0], $value[1], $value[2]);
            else:
                if(Schema::hasColumn($this->table, $key)):
                    if (strtotime($value) !== false):
                        $date_start = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d 00:00:00');
                        $date_end = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d 23:59:59');
                        $query->whereBetween($key, [$date_start, $date_end]);
                    else:
                        $query->where($key, '=', $value);
                    endif;
                endif;
            endif;
        endforeach;

        return $finish ? $query->get($columns) : $query;
    }

    public function createOrUpdate($compare, $insert = null)
    {
        return self::query()->updateOrCreate($compare, $insert);
    }
}
