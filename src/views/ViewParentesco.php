<?php

class ViewParentesco
{

    private function renderTableBody(array $rows): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['relacion']}</td>";
            $rowData .= "<td>{$row['nombre']}</td>";
            $rowData .= "<td>{$row['miembroId']}</td>";
            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='routes.php'>
                        <input type='hidden' name='_method' value='PUT'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-warning' type='submit'>Editar</button>
                    </form>
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


    private function renderSelectMiembro(array $rows): string
    {
        $rowData = '';
        foreach ($rows as $row ) {
            $rowData .= "<option value='{$row['id']}'> {$row['nombre']} </option>";
        }
        return "<tbody>$rowData</tbody>";
    }

    public function mostrar(array $parentescos, array $miembros): void
    {
        $title = 'Parentesco';
        $tbody = $this->renderTableBody($parentescos);
        $selectMiembros = $this->renderSelectMiembro($miembros);
        include '../src/templates/parentescos/index.html';
    }
}
