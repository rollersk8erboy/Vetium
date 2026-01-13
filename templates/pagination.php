<div class="justify-content-center mt-4 d-grid">
    <ul class="pagination pagination-sm">
        <li class="page-item <?php echo ((isset($_GET['page']) ? $_GET['page'] : 1) == 1) ? "disabled" : "" ?>"><a class="page-link" href="?page=1&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>">Primera</a></li>
        <li class="page-item <?php echo ((isset($_GET['page']) ? $_GET['page'] : 1) == 1) ? "disabled" : "" ?>"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) - 1 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>">Anterior</a></li>
        <li class="page-item disabled"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) ?>"><?php echo (isset($_GET['page']) ? $_GET['page'] : 1) ?></a></li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 1 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>"><?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 1 ?></a></li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 2 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>"><?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 2 ?></a></li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 3 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>"><?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 3 ?></a></li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 4 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>"><?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 4 ?></a></li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo (isset($_GET['page']) ? $_GET['page'] : 1) + 1 ?>&q=<?php echo isset($_GET['q']) ? $_GET['q'] : NULL ?>">Siguiente</a></li>
    </ul>
</div>