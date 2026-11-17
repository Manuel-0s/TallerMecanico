<?php
$titulo = 'Visi�n';
$paginaActual = 'nosotros';

include __DIR__ . '/../templates/public/header.php';
?>
<div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <i class="fa-solid fa-eye fs-1 text-primary mb-3"></i>
                    <h1 class="display-6 fw-bold mb-3">Nuestra Visión</h1>
                    <p class="lead text-secondary mb-4">
                        Ser el taller automotriz de mayor confianza en la región, reconocido por la excelencia técnica de nuestro equipo, la incorporación constante de tecnología de diagnóstico y un servicio honesto que convierta cada visita en una relación de largo plazo con nuestros clientes.
                    </p>
                    <a href="mission.php" class="btn btn-outline-primary">
                        <i class="fa-solid fa-arrow-left ms-1"></i> Ver Misión 
                    </a>
                    <a href="values.php" class="btn btn-outline-primary">
                        Ver Valores <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

<?php include __DIR__ . '/../templates/public/footer.php'; ?>
