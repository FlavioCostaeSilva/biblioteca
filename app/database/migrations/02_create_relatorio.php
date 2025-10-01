<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW RelatorioPorAutor AS
            SELECT
                A.CodAu,
                A.Nome AS AutorNome,
                GROUP_CONCAT(DISTINCT L.Titulo ORDER BY L.Titulo SEPARATOR ', ') AS TitulosLivros,
                GROUP_CONCAT(DISTINCT L.Editora ORDER BY L.Editora SEPARATOR ', ') AS Editoras,
                GROUP_CONCAT(DISTINCT ass.Descricao ORDER BY ass.Descricao SEPARATOR ', ') AS Assuntos
            FROM Autor A
            LEFT JOIN Livro_Autor LA ON A.CodAu = LA.Autor_CodAu
            LEFT JOIN Livro L ON LA.Livro_Codl = L.Codl
            LEFT JOIN Livro_Assunto LAs ON L.Codl = LAs.Livro_Codl
            LEFT JOIN Assunto ass ON LAs.Assunto_codAs = ass.codAs
            GROUP BY A.CodAu, A.Nome;
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS RelatorioPorAutor');
    }
};
