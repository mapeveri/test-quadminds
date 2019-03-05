<?php

namespace Tests\API\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexNotes()
    {
        $response = $this->get('/api/notes');

        $response->assertStatus(200);
    }

    public function testGetNote()
    {
        $note = factory('App\Note')->create();

        $response = $this->get('/api/notes/' . $note->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [ 'id', 'title', 'content'],
        ]);
    }

    public function testCreateNoteInvalid()
    {
        $response = $this->post('/api/notes', [
            'title' => '',
            'content' => 'Content test'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Invalid data.',
        ]);

        $response = $this->post('/api/notes', [
            'title' => 'Title test',
            'content' => ''
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Invalid data.',
        ]);
    }

    public function testCreateNote()
    {
        $response = $this->post('/api/notes', [
            'title' => 'Title test',
            'content' => 'Content test'
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateNoteInvalid()
    {
        $note = factory('App\Note')->create();

        // Put

        $response = $this->put('/api/notes/' . $note->id, [
            'title' => '',
            'content' => 'Content modified'
        ]);

        $response->assertStatus(200);
        $response->assertJson(array(
            'message' => 'Invalid data.',
        ));

        $response = $this->put('/api/notes/' . $note->id, [
            'title' => 'Title test',
            'content' => ''
        ]);

        $response->assertStatus(200);
        $response->assertJson(array(
            'message' => 'Invalid data.',
        ));

        // Patch

        $response = $this->patch('/api/notes/' . $note->id, [
            'title' => '',
            'content' => 'Content modified 2'
        ]);

        $response->assertStatus(200);
        $response->assertJson(array(
            'message' => 'Invalid data.',
        ));

        $response = $this->patch('/api/notes/' . $note->id, [
            'title' => 'Title test',
            'content' => ''
        ]);

        $response->assertStatus(200);
        $response->assertJson(array(
            'message' => 'Invalid data.',
        ));
    }

    public function testUpdateNote()
    {
        $note = factory('App\Note')->create();

        $response = $this->put('/api/notes/' . $note->id, [
            'title' => 'Title modified',
            'content' => 'Content modified'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [ 'id', 'title', 'content'],
        ]);

        $response = $this->patch('/api/notes/' . $note->id, [
            'title' => 'Title modified 2',
            'content' => 'Content modified 2'
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteNote()
    {
        $note = factory('App\Note')->create();

        $response = $this->delete('/api/notes/' . $note->id);

        $response->assertStatus(200);
    }
}
