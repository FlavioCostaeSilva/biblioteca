<?php

namespace Tests\Unit\Services;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Repositories\LivroRepositoryInterface;
use App\Services\LivroService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class LivroServiceTest extends TestCase
{
    use RefreshDatabase;

    protected MockInterface $repositoryMock;
    protected LivroService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(LivroRepositoryInterface::class);
        $this->service = new LivroService($this->repositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGetAllLivros(): void
    {
        $livros = collect([new Livro(), new Livro()]);
        $this->repositoryMock->shouldReceive('all')
            ->once()
            ->andReturn($livros);

        $result = $this->service->getAllLivros();

        $this->assertEquals($livros, $result);
    }

    public function testGetLivroById(): void
    {
        $id = 1;
        $livro = new Livro();
        $this->repositoryMock->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($livro);

        $result = $this->service->getLivroById($id);

        $this->assertEquals($livro, $result);
    }

    public function testCreateLivroSuccess(): void
    {
        $data = [
            'Titulo' => 'Test Title',
            'Editora' => 'Test Editora',
            'AnoPublicacao' => '2020',
            'Preco' => 10,
            'autores' => [1, 2],
            'assuntos' => [3, 4],
        ];

        $livroMock = Mockery::mock(Livro::class)->makePartial();

        $livroMock->shouldReceive('autores->attach')
            ->with($data['autores'])
            ->once();

        $livroMock->shouldReceive('assuntos->attach')
            ->with($data['assuntos'])
            ->once();

        $this->repositoryMock->shouldReceive('create')
            ->with($data)
            ->once()
            ->andReturn($livroMock);

        $result = $this->service->createLivro($data);

        $this->assertEquals($livroMock, $result);
    }

    public function testCreateLivroValidationFails(): void
    {
        $this->expectException(ValidationException::class);

        $invalidData = [
            'Titulo' => '', // Invalid
            'Editora' => 'Test Editora',
            'AnoPublicacao' => '2020',
            'Preco' => 10,
        ];

        $this->service->createLivro($invalidData);
    }

    public function testCreateLivroInvalidYear(): void
    {
        $this->expectException(ValidationException::class);

        $invalidData = [
            'Titulo' => 'Test Title',
            'Editora' => 'Test Editora',
            'AnoPublicacao' => '2026',
            'Preco' => 10,
        ];

        $this->service->createLivro($invalidData);
    }

    public function testUpdateLivroSuccess(): void
    {
        $id = 1;
        $data = [
            'Titulo' => 'Updated Title',
            'Editora' => 'Updated Editora',
            'AnoPublicacao' => '2021',
            'Preco' => 15,
            'autores' => [1],
            'assuntos' => [2],
        ];

        $livroMock = Mockery::mock(Livro::class)->makePartial();
        $this->repositoryMock->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($livroMock);

        $this->repositoryMock->shouldReceive('update')
            ->with($livroMock, $data)
            ->once()
            ->andReturn($livroMock);

        $livroMock->shouldReceive('autores->sync')
            ->with($data['autores'])
            ->once();

        $livroMock->shouldReceive('assuntos->sync')
            ->with($data['assuntos'])
            ->once();

        $result = $this->service->updateLivro($id, $data);

        $this->assertEquals($livroMock, $result);
    }

    public function testUpdateLivroValidationFails(): void
    {
        $id = 1;
        $this->expectException(ValidationException::class);

        $invalidData = [
            'Titulo' => '',
            'Editora' => 'Test Editora',
            'AnoPublicacao' => '2020',
            'Preco' => 10,
        ];

        $livroMock = Mockery::mock(Livro::class)->makePartial();
        $this->repositoryMock->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($livroMock);

        $this->service->updateLivro($id, $invalidData);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDeleteLivro(): void
    {
        $id = 1;
        $livroMock = Mockery::mock(Livro::class)
            ->makePartial();

        $this->repositoryMock->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($livroMock);

        $this->repositoryMock->shouldReceive('delete')
            ->with($livroMock)
            ->once();

        $this->service->deleteLivro($id);
    }

    public function testGetAutoresAndAssuntos(): void
    {
        Autor::factory()->count(2)->create();
        Assunto::factory()->count(3)->create();

        $result = $this->service->getAutoresAndAssuntos();

        $this->assertCount(2, $result['autores']);
        $this->assertCount(3, $result['assuntos']);
    }
}
