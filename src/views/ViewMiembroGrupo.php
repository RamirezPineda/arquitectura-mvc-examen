<?php

class ViewMiembroGrupo
{

    private function renderTableBody(array $rows, array $miembros, array $grupos): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-miembrogrupo'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['rol']}</td>";
            $rowData .= "<td>{$row['fechaIngreso']}</td>";

            foreach ($miembros as $miembro) {
                if ($miembro['id'] === $row['miembroId']) {
                    $rowData .= "<td>{$miembro['nombre']}</td>";
                    break;
                }
            }
            foreach ($grupos as $cargo) {
                if ($cargo['id'] === $row['grupoId']) {
                    $rowData .= "<td>{$cargo['nombre']}</td>";
                    break;
                }
            }

            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='miembrogrupos.php'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-danger' type='submit'>Eliminar</button>
                    </form>
                    </div>
                </td>    
            ";

            $rowData .= "<td class='visually-hidden'>{$row['miembroId']}</td>";
            $rowData .= "<td class='visually-hidden'>{$row['grupoId']}</td>";

            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }


    private function renderSelectMiembros(array $rows)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='miembroId' class='form-label'>Miembro de la iglesia</label>";
        $rowData .= "<select class='form-select' name='miembroId' id='miembroId'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }

    private function renderSelectgrupos(array $rows)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='miembroId' class='form-label'>Cargo</label>";
        $rowData .= "<select class='form-select' name='grupoId' id='grupoId'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }


    public function mostrar(array $miembrogrupos,  array $miembros, array $grupos): void
    {
        $title = 'Grupos de los miembros de la iglesia';
        $tbody = $this->renderTableBody($miembrogrupos, $miembros, $grupos);

        $selectMiembros = $this->renderSelectMiembros($miembros);
        $selectGrupos = $this->renderSelectgrupos($grupos);

        include '../src/templates/miembrogrupos/index.html';
    }
}
