<?php
class UsuarioView {
    public function mostrarLista($usuarios) {
        echo "<h2>Lista de Usuários</h2>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";
        foreach ($usuarios as $usuario) {
            echo "<tr>
                    <td>{$usuario['id_usuario']}</td>
                    <td>{$usuario['nome']}</td>
                    <td>{$usuario['email']}</td>
                  </tr>";
        }
        echo "</table>";
    }

    public function mostrarUsuario($usuario) {
        echo "<h2>Detalhes do Usuário</h2>";
        echo "ID: {$usuario['id_usuario']} <br>";
        echo "Nome: {$usuario['nome']} <br>";
        echo "Email: {$usuario['email']} <br>";
    }
}
