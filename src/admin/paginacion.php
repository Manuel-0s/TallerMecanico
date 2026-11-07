<?php
$pagina = $pagina ?? 1;
$totalPaginas = $totalPaginas ?? 1;

if ($totalPaginas > 1):
    $params = $_GET;
    unset($params['pagina']);
    $url = fn($p) => '?' . http_build_query($params + ['pagina' => $p]);

    $inicio = max(1, $pagina - 2);
    $fin = min($totalPaginas, $pagina + 2);
?>

<nav aria-label="Paginación" class="page navigation d-flex justify-content-between align-items-center px-4 py-3 border-top">
    <small class="text-muted">Página <?= $pagina ?> de <?= $totalPaginas ?></small>

    <ul class="pagination pagination-sm ">
        <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= $url($pagina - 1) ?>">Anterior</a>
        </li>

        <?php if ($inicio > 1): ?>
            <li class="page-item"><a class="page-link" href="<?= $url(1) ?>">1</a></li>
            <?php if ($inicio > 2): ?><li class="page-item disabled"><span class="page-link">…</span></li><?php endif; ?>
        <?php endif; ?>

        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
            <li class="page-item <?= $i === $pagina ? 'active' : '' ?>">
                <a class="page-link" href="<?= $url($i) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($fin < $totalPaginas): ?>
            <?php if ($fin < $totalPaginas - 1): ?><li class="page-item disabled"><span class="page-link">…</span></li><?php endif; ?>
            <li class="page-item"><a class="page-link" href="<?= $url($totalPaginas) ?>"><?= $totalPaginas ?></a></li>
        <?php endif; ?>

        <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= $url($pagina + 1) ?>">Siguiente</a>
        </li>
    </ul>
</nav>
<?php endif; ?>