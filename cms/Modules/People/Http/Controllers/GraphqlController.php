<?php

namespace Modules\People\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \GraphQL\Type\Definition\ObjectType;
use \GraphQL\Type\Definition\Type;
use \GraphQL\GraphQL;
use \GraphQL\Type\Schema;
use Modules\People\Entities\Person;
use App\User;

class GraphqlController extends Controller
{
    public function handle(Request $request)
    {
        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'people' => [
                    'type' => Type::int(),
                    //'args' => [],
                    'resolve' => function() {
                        return time();
                    }
                ],
                'add' => [
                    'type'  => Type::int(),
                    'args' => [
                        'first' => Type::int(),
                        'second' => Type::int()
                    ],
                    'resolve' => function($root, $args) {
                        return $args['first'] + $args['second'];
                    }
                ],
                'username' => [
                    'type' => Type::string(),
                    'args' => [
                        'id' => Type::string()
                    ],
                    'resolve' => function($root, $args) {
                        $user = User::find($args['id']);
                        return $user->name;
                    }
                ]
            ],
        ]);

        $schema = new Schema([
            'query' => $queryType
        ]);

        $rootValue = ['prefix' => 'You said: '];

        $result = GraphQL::executeQuery($schema, $request->post('query'), $rootValue, null, null);
        $output = $result->toArray();

        return $output;
    }
}
