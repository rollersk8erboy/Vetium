<form class="card bg-light mb-3" method="get" autocomplete="off">
    <div class="card-body row align-items-center">
        <div class="col">
            <input class="form-control" placeholder="Buscar" type="text" name="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : "" ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-dark" type="submit"><i class='fas fa-filter'></i> Filtrar</button>
        </div>
    </div>
</form>