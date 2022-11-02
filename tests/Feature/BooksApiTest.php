<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_books()
    {
        $books = Book::factory(4)->create();

        $this->getJson(route('books.index'))
            ->assertJsonFragment([
                'title' => $books[0]->title,
            ])
            ->assertJsonFragment([
                'title' => $books[0]->title,
            ]);
    }

    /** @test */
    function can_get_one_book()
    {
        $book = Book::factory()->create();

        $this->getJson(route('books.index'))
            ->assertJsonFragment([
                'title' => $book->title,
            ]);

    }

    /** @test */
    function can_create_book()
    {
        $this->postJson(route('books.store'),[])
            ->assertJsonValidationErrorFor('title');

        $this->postJson(route('books.store'), [
            'title' => 'My new book',
        ])->assertJsonFragment([
            'title' => 'My new book',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'My new book',
        ]);
    }

    /** @test */
    function can_update_book()
    {
        $book = Book::factory()->create();

        $this->patchJson(route('books.update', $book),[])
            ->assertJsonValidationErrorFor('title');

        $this->patchJson(route('books.update', $book), [
            'title' => 'My new book edited',
        ])->assertJsonFragment([
            'title' => 'My new book edited',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'My new book edited',
        ]);
    }

    /** @test */
    function can_delete_book()
    {
        $book = Book::factory()->create();

        $this->deleteJson(route('books.delete', $book))
            ->assertNoContent();

        $this->assertDatabaseCount('books', 0);
    }
}
