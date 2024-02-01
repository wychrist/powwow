<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Metadata;

trait ApiTrait
{
  // Create this variable if you want to re-map your filters conlumns
  /*protected $fieldsMap = [
        'person_id' => 'id'
    ];*/

  // Create this variable if you want values from the "with"
  // query to be processed and used on the builder a relationships' "with"
  /* protected $processWithQueryFilter = false; */

  public function  buildQuery($class): object
  {
    $request = request();
    $query = (is_object($class)) ? $class : $class::query();

    if (is_callable([$query, 'withTrashed']) && $request->input('trashed', false)) {
      $query::withTrashed();
    }

    if ($request->query('sort', false)) {
      foreach (explode(',', $request->query('sort')) as $field) {
        if ($field[0] == '-') {
          $query->orderBy(substr($field, 1), 'desc');
        } else {
          $query->orderBy($field);
        }
      }
    }

    if ($request->query('filter', false)) {
      foreach ($request->query('filter') as $aFilter => $args) {
        $query  = $this->callFilter($query, $aFilter, $args);
      }
    }

    if ($request->query('rel', false)) {
      foreach ($request->query('rel') as $type => $value) {
        switch (strtolower($type)) {
          case 'with':
            $withs = explode(',', str_replace(' ', '', $value));
            $this->inFilter($withs, $query);
            break;
        }
      }
    }

    if ($this->shouldAddWithToDbQuery()) {
      try {
        $with = $request->query('with', '');
        $model = $query->getModel();
        $handlers = $this->getWithHandlers();
        foreach (explode(',', $with) as $aWith) {
          $name = explode('.', $aWith)[0];
          if (isset($handlers[$aWith])) {
            $handlers[$aWith]($query);
          } elseif (method_exists($model, $name)) {
            $query->with($name);
          } elseif (method_exists($model, Str::camel($name))) {
            $query->with(Str::camel($name));
          } elseif (method_exists($model, $aWith)) {
            $query->with($aWith);
          } elseif (method_exists($model, Str::camel($aWith))) {
            $query->with(Str::camel($aWith));
          } elseif (strstr($aWith, '.')) {
            $query->with($aWith);
          }
        }
      } catch (\Exception $_) {
        // do nothing from now
      }
    }


    return $query;
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


  public function toResponseArray(string $resource, $response, $id = false)
  {
    return [
      'resource' => $resource,
      'response' => $response,
      'id' => $id,
    ];
  }

  /**
   * Further process "where" filter
   *
   * eg: filter[where][id]=is_null  => will do an is null query
   *     filter[where][id]=is_not_null => will do an is not null query
   *
   *  You can change the filter via the where or "or_where" query as w3ell
   *  eg: filter[where][id:in]=1,2,3 => will do a where in query
   *      filter[or_where][id:in]=1,2,3 => will do a "or_where" in query
   */
  protected function processWhereCondition($query, $field, $value, bool $byAnd = true)
  {
    $pieces = explode(':', $field);
    if (count($pieces) == 1) {
      switch (trim($value)) {
        case 'is_null':
          $query->whereNull($field);
          break;
        case 'is_not_null':
          $query->whereNotNull($field);
          break;
        default:
          if ($byAnd) {
            $query->where($this->getMapName($this->getMapName($field)), $value);
          } else {
            $query->orWhere($this->getMapName($field), $value);
          }
      }
    } else {
      $fieldName = $pieces[0];
      $filter = $pieces[1];
      $query = $this->callFilter($query, $filter, [$fieldName => $value]);
    }

    return $query;
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
        $query = $this->processWhereCondition($query, $field, $value);
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
        $query = $this->processWhereCondition($query, $field, $value, false);
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

  protected function orNotFilter(array $arg, object $query): object
  {
    return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

      foreach ($arg as $field => $value) {
        $query->orWhere($this->getMapName($field), '!=', $value);
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
   * Filter for: not_in
   *
   * @param array $arg
   * @param Builder $query
   * @return Builder
   */
  protected function orNotInFilter(array $arg, object $query): object
  {
    return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {

      foreach ($arg as $field => $value) {
        $query->orWhereNotIn($this->getMapName($field), explode(',', $value));
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
          if (is_array($filterArray)) {
            foreach ($filterArray as $filter => $filterArg) { // filter loop
              $this->callFilter($q, $filter, $filterArg);
            }
          }
        });
      }

      return $query;
    });
  }

  /**
   * Filter for: or_where_has
   *
   * eg: filter[or_where_has][contacts][like|where|in..][field] = value
   *
   * @param array $arg
   * @param Builder $query
   * @return Builder
   */
  protected function orWhereHasFilter(array $arg, object $query): object
  {
    return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
      foreach ($arg as $relationship => $filterArray) { // relationships loop
        $query->whereHas($relationship, function ($q) use ($filterArray) {
          if (is_array($filterArray)) {
            foreach ($filterArray as $filter => $filterArg) { // filter loop
              $this->callFilter($q, $filter, $filterArg);
            }
          }
        });
      }
    });
  }

  /**
   * Filter for: where_doesnt_have
   *
   * eg: filter[where_doesnt_have][contacts][like|where|in..][field] = value
   * eg: filter[where_doesnt_have][contacts]
   *
   * @param array $arg
   * @param Builder $query
   * @return Builder
   */
  protected function whereDoesntHaveFilter(array $arg, object $query): object
  {
    return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
      foreach ($arg as $relationship => $filterArray) {
        $query->whereDoesntHave($relationship, function ($q) use ($filterArray) {
          if (is_array($filterArray)) {
            foreach ($filterArray as $filter => $filterArg) {
              $this->callFilter($q, $filter, $filterArg);
            }
          }
        });
      }
    });
  }

  /**
   * Filter for: or_where_doesnt_have
   *
   * eg: filter[or_where_doesnt_have][contacts][like|where|in..][field] = value
   * eg: filter[or_where_doesnt_have][contacts]
   *
   * @param array $arg
   * @param Builder $query
   * @return Builder
   */
  protected function orWhereDoesntHaveFilter(array $arg, object $query): object
  {
    return $this->safelyCallFilterMethod($query, function () use ($query, $arg) {
      foreach ($arg as $relationship => $filterArray) {
        $query->orWhereDoesntHave($relationship, function ($q) use ($filterArray) {
          if (is_array($filterArray)) {
            foreach ($filterArray as $filter => $filterArg) {
              $this->callFilter($q, $filter, $filterArg);
            }
          }
        });
      }
    });
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

  public function incFilter($arg, object $query): object
  {
    if ($arg) {
      $handlers = $this->getIncHandlers();
      $arg = (is_array($arg)) ? $arg : explode(',', $arg);

      foreach ($arg as $name) {
        if (isset($handlers[$name])) {
          $handlers[$name]($query);
        } else {
          $query->with($name);
        }
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

  protected function resourceNameToFolderName($name)
  {
    return  str_replace('app_', '', strtolower(str_replace('\\', '_', $name))); // App\Person => app_person => person
  }

  protected function buildResourceCacheId($name, $id = '', $surfix = '')
  {
    return strtolower(str_replace('\\', '_', $name . $id . $surfix));
  }

  public function parseResourceHash(?string $hash = null): ?array
  {
    return [];
    // if (is_array($parsed)) {
    //     return [
    //         'resourceType' => $parsed['resource'] ?? '',
    //         'resourceId' => $parsed['id'] ?? ''
    //     ];
    // }

    // return $parsed;
  }

  public function getParsedResourceHash(?string $resource_hash = null): array
  {
    $request = request();
    return $this->parseResourceHash($resource_hash ?? $request->get('resource_hash', [
      'resourceType' =>  $request->get('resourceType'),
      'resourceId' => $request->get('resourceId', 0)
    ]));
  }

  protected function getWithHandlers(): array
  {
    return [];
  }

  protected function getIncHandlers(): array
  {
    return [];
  }


  /**
   * Should add the query query "with" to the sql query ?
   *
   * The value from the query params is not added to the
   * generated sql. It is up to the resource's resource class
   * to handle this param.
   *
   * @return true
   */
  protected function shouldAddWithToDbQuery(): bool
  {
    return (isset($this->processWithQueryFilter)) ? (bool) $this->processWithQueryFilter : false;
  }
}
