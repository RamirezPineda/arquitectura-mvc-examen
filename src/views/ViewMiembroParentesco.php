<?php

class ViewMiembroParentesco
{

    private function renderTableBody(array $rows, array $miembros, array $parentescos): string
    {
        $rowData = '';
        foreach ($rows as $row) {
            $rowData .= "<tr class='fila-miembroparentesco'>";
            $rowData .= "<th scope='row'>{$row['id']}</th>";

            foreach ($miembros as $miembro) {
                if ($miembro['id'] === $row['miembroId']) {
                    $rowData .= "<td>{$miembro['nombre']}</td>";
                    break;
                }
            }
            foreach ($miembros as $familiar) {
                if ($familiar['id'] === $row['familiarId']) {
                    $rowData .= "<td>{$familiar['nombre']}</td>";
                    break;
                }
            }

            foreach ($parentescos as $cargo) {
                if ($cargo['id'] === $row['parentescoId']) {
                    $rowData .= "<td>{$cargo['nombre']}</td>";
                    break;
                }
            }

            $rowData .= "
                <td>
                    <div  class='d-flex justify-content-start gap-2'>
                    <form method='POST' action='miembroparentescos.php'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='btn btn-danger' type='submit'>Eliminar</button>
                    </form>
                    </div>
                </td>    
            ";

            $rowData .= "<td class='visually-hidden'>{$row['miembroId']}</td>";
            $rowData .= "<td class='visually-hidden'>{$row['familiarId']}</td>";
            $rowData .= "<td class='visually-hidden'>{$row['parentescoId']}</td>";

            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }


    private function renderSelectMiembros(array $rows, string $atributo, string $title)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='{$atributo}' class='form-label'>{$title}</label>";
        $rowData .= "<select class='form-select' name='{$atributo}' id='{$atributo}'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }

    private function renderSelectParentescos(array $rows)
    {
        $rowData = "<div class='mb-3 col'>";
        $rowData .= "<label for='miembroId' class='form-label'>Cargo</label>";
        $rowData .= "<select class='form-select' name='parentescoId' id='parentescoId'>";

        foreach ($rows as $row) {
            $rowData .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }

        return "$rowData</select> </div>";
    }


    public function mostrar(array $miembroparentescos,  array $miembros, array $parentescos): void
    {
        $title = 'Miembros - Parentescos';
        $tbody = $this->renderTableBody($miembroparentescos, $miembros, $parentescos);

        $selectMiembros = $this->renderSelectMiembros($miembros, 'miembroId', 'Miembros de la iglesia');
        $selectFamiliares = $this->renderSelectMiembros($miembros, 'familiarId', 'Famliar');
        $selectParentescos = $this->renderSelectParentescos($parentescos);

        include '../src/templates/miembroparentescos/index.html';
    }
}
