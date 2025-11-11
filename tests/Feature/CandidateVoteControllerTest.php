<?php

test('example', function () {
    $response = $this->post('/vote');

    $response->assertStatus(200);
});
