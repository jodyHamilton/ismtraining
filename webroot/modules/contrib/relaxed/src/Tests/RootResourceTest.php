<?php

namespace Drupal\relaxed\Tests;

use Drupal\Component\Serialization\Json;

/**
 * Tests the relaxed:root resource.
 *
 * @group relaxed
 */
class RootResourceTest extends ResourceTestBase {

  public function testGet() {
    $this->enableService('relaxed:root', 'GET');

    // Create a user with the correct permissions.
    $permissions[] = 'restful get relaxed:root';
    $account = $this->drupalCreateUser($permissions);
    $this->drupalLogin($account);

    $response = $this->httpRequest('', 'GET', NULL);
    $this->assertResponse('200', 'HTTP response code is correct.');
    $this->assertHeader('content-type', $this->defaultMimeType);
    $data = Json::decode($response);

    $request = \Drupal::request();
    $uuid = $uuid = MD5($request->getHost() . $request->getPort());
    $expected = [
      'couchdb' => 'Welcome',
      'uuid' => $uuid,
      'vendor' => [
        'name' => 'Drupal',
        'version' => \Drupal::VERSION,
      ],
      'version' => \Drupal::VERSION,
    ];
    $this->assertIdentical($expected, $data, ('Correct values in response.'));
  }

}
