<?php

class ViewActividad
{

    private function renderTableBody(array $rows, array $grupos): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-actividad'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['nombre']}</td>";
            $rowData .= "<td>{$row['lugar']}</td>";
            $rowData .= "<td>{$row['hora']}</td>";

            foreach ($grupos as $grupo) {
                if ($grupo['id'] === $row['grupoId']) {
                    $rowData .= "<td>{$grupo['nombre']}</td>";
                    break;
                }
            }

            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='actividades.php'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-danger' type='submit'>Eliminar</button>
                    </form>
                    </div>
                </td>    
            ";

            $rowData .= "<td class='visually-hidden'>{$row['grupoId']}</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    private function renderSelectgrupos(array $rows)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='miembroId' class='form-label'>grupo</label>";
        $rowData .= "<select class='form-select' name='grupoId' id='grupoId'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }

    public function mostrar(array $actividades, array $grupos): void
    {
        $title = 'Actividades de los grupos de la iglesia';
        $tbody = $this->renderTableBody($actividades, $grupos);
        $selectGrupos = $this->renderSelectgrupos($grupos);

        include '../src/templates/actividades/index.html';
    }
}
