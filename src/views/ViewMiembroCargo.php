<?php

class ViewMiembroCargo
{

    private function renderTableBody(array $rows, array $miembros, array $cargos): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-miembrocargo'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";
            $rowData .= "<td>{$row['fechaInicio']}</td>";

            $fechaFin = $row["fechaFinalizacion"] !== "" ? $row["fechaFinalizacion"] : "------";

            $rowData .= "<td>{$fechaFin}</td>";

            foreach ($miembros as $miembro) {
                if ($miembro['id'] === $row['miembroId']) {
                    $rowData .= "<td>{$miembro['nombre']}</td>";
                    break;
                }
            }
            foreach ($cargos as $cargo) {
                if ($cargo['id'] === $row['cargoId']) {
                    $rowData .= "<td>{$cargo['nombre']}</td>";
                    break;
                }
            }

            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='miembrocargos.php'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-danger' type='submit'>Eliminar</button>
                    </form>
                    </div>
                </td>    
            ";

            $rowData .= "<td class='visually-hidden'>{$row['miembroId']}</td>";
            $rowData .= "<td class='visually-hidden'>{$row['cargoId']}</td>";

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

    private function renderSelectCargos(array $rows)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='miembroId' class='form-label'>Cargo</label>";
        $rowData .= "<select class='form-select' name='cargoId' id='cargoId'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }


    public function mostrar(array $miembrocargos,  array $miembros, array $cargos): void
    {
        $title = 'Cargos de los miembros de la iglesia';
        $tbody = $this->renderTableBody($miembrocargos, $miembros, $cargos);

        $selectMiembros = $this->renderSelectMiembros($miembros);
        $selectCargos = $this->renderSelectCargos($cargos);

        include '../src/templates/miembrocargos/index.html';
    }
}
