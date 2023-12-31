<?php

class ViewParentesco
{

    private function renderTableBody(array $rows): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-parentesco'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['nombre']}</td>";
            $rowData .= "<td>{$row['descripcion']}</td>";
            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='parentescos.php'>
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

    public function mostrar(array $parentescos): void
    {
        $title = 'Parentescos';
        $tbody = $this->renderTableBody($parentescos);
        include '../src/templates/parentescos/index.html';
    }
}
