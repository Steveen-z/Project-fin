<?php
require_once '../conexion.php';

$id = $_POST['id'];

$query = "SELECT * FROM entrenadores WHERE id_entrenador = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$entrenador = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Entrenador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editarEntrenadorForm">
                <input type="hidden" name="id_entrenador" value="<?php echo htmlspecialchars($entrenador['id_entrenador']); ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($entrenador['nombre']); ?>">
                </div>
                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($entrenador['especialidad']); ?>">
                </div>
                <div class="form-group">
                    <label for="experiencia">Experiencia</label>
                    <input type="number" class="form-control" id="experiencia" name="experiencia" value="<?php echo htmlspecialchars($entrenador['experiencia']); ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($entrenador['telefono']); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($entrenador['email']); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
   