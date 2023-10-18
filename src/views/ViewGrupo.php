<?php

class ViewGrupo
{

    private function renderTableBody(array $rows): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-grupo'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['nombre']}</td>";
            $rowData .= "<td>{$row['descripcion']}</td>";
            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='grupos.php'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-danger' type='submit'>Eliminar</button>
                    </form>
                    </div>
                </td>    
            ";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function mostrar(array $grupos): void
    {
        $title = 'Grupos de la iglesia';
        $tbody = $this->renderTableBody($grupos);
        include '../src/templates/grupos/index.html';
    }
}
