<?php
// api/src/OpenApi/JwtDecorator.php

declare(strict_types=1);

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class JwtDecorator implements OpenApiFactoryInterface
{
    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
            ],
        ]);
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'john.doe@example.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'password',
                ],
            ],
            /* 'headers' => [
                'username' => [
                    'type' => 'string',
                    'in' => 'header',
                    'example' => 'john.doe',
                ],
            ], */
        ]);

        $responses = [
            '200' => [
                'description' => 'Get JWT token',
                'content' => [
                    'application/json' => [
                        'schema' => [
                            '$ref' => '#/components/schemas/Token',
                        ],
                    ],
                ]
            ],
            '400' => ['description' => 'Bad request - Invalid JSON'],
            '401' => ['description' => 'Bad credentials'],
        ];

        $content = new \ArrayObject([
            'application/json' => [
                'schema' => [
                    '$ref' => '#/components/schemas/Credentials',
                ],
            ],
        ]);

        $requestBody = new Model\RequestBody('Generate new JWT Token', $content);
        $post = new Model\Operation('postCredentialsItem', ['Authentication'], $responses, 'Get JWT token to login.', '', new Model\ExternalDocumentation, [], $requestBody);
        $pathItem = new Model\PathItem('JWT Token', null, null, null, null, $post);

        $openApi->getPaths()->addPath('/api/login', $pathItem);

        return $openApi;
    }
}
