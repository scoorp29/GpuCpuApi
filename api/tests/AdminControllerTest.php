<?php
/**
 * Created by PhpStorm.
 * User: Ecole-IPPSI
 * Date: 01/02/2019
 * Time: 10:50
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AdminControllerTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        exec('php bin/console hautelook:fixtures:load --purge-with-truncate');

        parent::setUpBeforeClass();
    }

    /**
     * @group SuccesAdmin
     */
    public function testGetApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('GET', '/api/admin/profile', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );
        $response = $client->getResponse();
        $userjson = $response->getContent();
        $user = \json_decode($userjson, true);
        $this->assertArrayHasKey('id', $user);
        $this->assertArrayHasKey('firstname', $user);
        $this->assertArrayHasKey('lastname', $user);
        $this->assertArrayHasKey('email', $user);
        $this->assertArrayHasKey('adress', $user);
        $this->assertArrayHasKey('country', $user);
        $this->assertArrayHasKey('roles', $user);
        $this->assertArrayHasKey('apiKey', $user);
        $this->assertArrayHasKey('subscription', $user);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group SuccesAdmin
     */
    public function testPatchApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/profile', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditAdminName",
            "lastname": "EditAdminLastName",
            "email": "testPatchApiAdminProfile@gmail.com",
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group FailAdmin
     */
    public function testPatchFailApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/profile', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditAdminName",
            "lastname": "EditAdminLastName",
            "email": "testPatchApiAdminProfile",
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

}