<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait ApiTrait
{

    // Create this variable if you want to re-map your filters conlumns
    /*protected $fieldsMap = [
        'person_id' => 'id'
    ];*/

    public function preHandleRequest($class,  array $params = []): Builder
    {
        $params = empty($params) ? request()->all() : $params;

        if (method_exists($class, 'withTrashed')) {
            if (array_key_exists('trashed', $params)  && $params['trashed']) {
                if (is_object($class)) {
                    $query = $class;
                    $query->withTrashed();
                } else {
                    $query = $class::withTrashed();
                }
            } else {
                if (is_object($class)) {
                    $query = $class;
                    $query->withoutTrashed();
                } else {
                    $query  = $class::withoutTrashed();
                }
            }
        } else {
            $query = (is_object($class)) ? $class : $class::query();
        }

        if (array_key_exists('sort', $params)) {
            foreach (explode(',', $params['sort']) as $field) {
                if ($field[0] == '-') {
                    $query->orderBy(substr($field, 1), 'desc');
                } else {
                    $query->orderBy($field);
                }
            }
        }

        if (array_key_exists('filter', $params) && is_array($params['filter'])) {
            $query->where(function ($query) use ($params) {
                foreach ($params['filter'] as $aFilter => $args) {
                    $query  = $this->callFilter($query, $aFilter, $args);
                }

                return $query;
            });
        }


        if(array_key_exists('with', $params)) {
            $with = explode(',', $params['with']);
            foreach ($with as $index => $value) {
                $with[$index] = $this->getMapName($value);
            }

            $query->with($with);
        }

        return $query;
    }

    public function postHandleRequest($result)
    {

    }

    /**
     * Call a filter handler
     *
     * @param Object $query the current query instance
     * @param string $aFilter the name of the filter
     * @param mixed $args Arguements to pass to this handler
     *
     * @return Object The query instance that was passed
     */
    public function callFilter(object $query, string $aFilter, $args): object
    {
        $method = Str::camel($aFilter) . 'Filter'; // filter name should be camel case. eg: whereFilter(array $arg, Builder $query): Builder
        if (method_exists($this, $method)) {
            $query = $this->{$method}($args, $query);
        }

        return $query;
    }

    /**
     * Gracefully try to paginate the result
     *
     * @param Object $query The query instance
     * @param Request|null $request
     *
     * @return LengthAwarePaginator
     */
    public function paginate($query, $request = null): LengthAwarePaginator
    {
        $request = $request ?: request();

        $ignore  = [
            'api_token',
            'page'
        ];

        if (is_numeric($request->query('limit', false))) {
            $limit = $request->query('limit');
            $paginator =  $query->paginate($limit);
        } else {
            $paginator = $query->paginate();
        }

        foreach ($request->query() as $key  => $value) {
            if (!in_array($key, $ignore)) {
                $paginator->appends($key, $value);
            }
        }

        return $paginator;
    }

    /**
     * Filter for: where
     *
     * @param array $arg
     * @param Builder $query
     *
     * @return Builder
     */
    protected function whereFilter(array $arg, object $query): object
    {
        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
            foreach ($arg as $field => $value) {
                $query->where($this->getMapName($this->getMapName($field)), $value);
            }

            return $query;
        });
    }

    /**
     * Filter for: or_where
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function orWhereFilter(array $arg, object $query): object
    {
        return $this->safelyCallFilterMethod($query, function () use ($arg, $query) {
            foreach ($arg as $field => $value) {
                $query->orWhere($this->getMapName($field), $value);
            }
            return $query;
        });
    }

    /**
     * Filter for: in
     *
     * @param array $arg
     * @param Builder $query
     *
     * @return Builder
     */
    protected function inFilter(array $arg, object $query): object
    {

        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
            foreach ($arg as $field => $value) {
                $query->whereIn($this->getMapName($field), explode(',', $value));
            }

            return $query;
        });
    }

    /**
     * Filter for: or_in
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function orInFilter(array $arg, object $query): object
    {

        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

            foreach ($arg as $field => $value) {
                $query->orWhereIn($this->getMapName($field), explode(',', $value));
            }

            return $query;
        });
    }

    /**
     * Filter for: like
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function likeFilter(array $arg, object $query): object
    {
        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
            foreach ($arg as $field => $value) {
                $query->where($this->getMapName($field), 'like', $value);
            }

            return $query;
        });
    }

    /**
     * Filter for: or_like
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function orLikeFilter(array $arg, object $query): object
    {

        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

            foreach ($arg as $field => $value) {
                $query->orWhere($this->getMapName($field), 'like', $value);
            }

            return $query;
        });
    }

    /**
     * Filter for: not
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function notFilter(array $arg, object $query): object
    {

        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

            foreach ($arg as $field => $value) {
                $query->where($this->getMapName($field), '!=', $value);
            }

            return $query;
        });
    }

    /**
     * Filter for: not_in
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function notInFilter(array $arg, object $query): object
    {
        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

            foreach ($arg as $field => $value) {
                $query->whereNotIn($this->getMapName($field), explode(',', $value));
            }

            return $query;
        });
    }

    /**
     * Filter for: where_has
     *
     * eg: filter[where_has][contacts][like|where|in..][field] = value
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function whereHasFilter(array $arg, object $query): object
    {
        return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
            foreach ($arg as $relationship => $filterArray) { // relationships loop
                $query->whereHas($relationship, function ($q) use ($filterArray) {
                    foreach ($filterArray as $filter => $filterArg) { // filter loop
                        $method = Str::camel($filter) . 'Filter';
                        $this->$method($filterArg, $q);
                    }
                });
            }
        });
        return $query;
    }

    /**
     * Filter for: where | or_where that allows you to set the operator
     *
     * @eg: filter[condition][start_date][g]=2020-04-22
     *
     * Valid operators are:  'e' => '=', 'g' => '>', 'l' => '<', 'le' => '<=', 'ge' <= '>=
     *
     * @param array $arg
     * @param Builder $query
     * @return Builder
     */
    protected function conditionFilter(array $arg, object $query): object
    {
        foreach ($arg as $condition => $fields) {
            $filter = $condition;
            switch ($condition) {
                case 'where':
                    $filter = 'where';
                    break;
                case 'or_where':
                    $filter = 'orWhere';
                    break;
            }

            foreach ($fields as $aField => $conditions) {
                $operator = '=';
                foreach ($conditions as $op => $opArgs) {
                    $operator = $op;
                    switch ($op) {
                        case 'e':
                        case 'equal':
                            $operator = '=';
                            break;
                        case 'g':
                        case 'greater':
                        case 'greater_than';
                        case 'greaterthan';
                            $operator = '>';
                            break;
                        case 'l':
                        case 'less':
                        case 'less_than':
                        case 'lessthan':
                        case 'lesser_than':
                        case 'lesserthan':
                            $operator = '<';
                            break;
                        case 'ge':
                        case 'greater_than_or_equal':
                        case 'greaterthanorequal':
                            $operator  = '>=';
                            break;
                        case 'le':
                        case 'less_than_or_equal':
                        case 'lessthanorequal':
                        case 'lesser_than_or_equal':
                        case 'lesserthanorequal':
                            $operator = '<=';
                            break;
                    }
                }

                $query->$filter($aField, $operator, $opArgs);
            }
        }
        return $query;
    }

    protected function safelyCallFilterMethod(object $query, callable $callback)
    {

        try {
            return $callback() ?: $query;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }

        return $query;
    }

    protected function buildBatchError(Exception $ex)
    {
        if (method_exists($ex, 'errors')) {
            return $ex->errors();
        } else {
            return [
                'generic' => [
                    $ex->getMessage()
                ]
            ];
        }
    }

    protected function getMapName($field)
    {
        if (isset($this->fieldsMap) && isset($this->fieldsMap[$field])) {
            return $this->fieldsMap[$field];
        } else {
            return $field;
        }
    }
}
