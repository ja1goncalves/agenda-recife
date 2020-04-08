<?php


namespace App\Services;


use App\Model\Report;

class ReportsService extends AppService
{

    /**
     * @var Report
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param Report $model
     */
    public function __construct(Report $model)
    {
        $this->model = $model;
    }

    public function all($data = [])
    {
        $filters = $this->filters($data);
        $reports = $this->model->findWhere($filters)
            ->orderBy('created_at', 'DESC')
            ->paginate($filters['limit'] ?? 15);

        return [
            'reports' => $reports,
            'filter' => [
                'subject' => $filters['subject'] ?? '',
                'email' => $filters['email'] ?? '',
                'created_at' => $data['created_at'] ?? '',
                'motivation' => $filters['motivation'] ?? '',
            ]
        ];
    }

    public function create(array $data)
    {
        return $this->model->add($data);
    }
}
