<?php

class ViewMiembro
{

    private function renderTableBody(array $rows): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-miembro'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['ci']}</td>";
            $rowData .= "<td>{$row['nombre']}</td>";
            $rowData .= "<td>{$row['telefono']}</td>";
            $rowData .= "<td>{$row['edad']}</td>";
            $rowData .= "<td>{$row['fechaIngreso']}</td>";
            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='routes.php'>
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

    public function mostrar(array $miembros): void
    {
        $title = 'Miembros de la iglesia';
        $tbody = $this->renderTableBody($miembros);
        include '../src/templates/miembros/index.html';
    }
}






// <form method='POST' action='routes.php'>
// <input type='hidden' name='_method' value='PUT'>
// <input type='hidden' name='id' value='{$row['id']}'>
// <button class='btn btn-warning' type='submit'>Editar</button>
// </form>