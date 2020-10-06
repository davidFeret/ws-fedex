<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servidor de prueba</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid my-3">

        <h1 class='text-center'>Servicio web de costo de envíos (servidor de prueba)</h1>

        <div id='alert-message' class="alert alert-warning alert-dismissible fade show" role="alert">
            Geo's message: NMP significa New Mexican Peso, que es Peso Mexicano. <br>
            De aquí se puede conseguir información: 
            <a target='_blank' href="https://www.fedex.com/us/developer/WebHelp/ws/2014/dvg/WS_DVG_WebHelp/index.htm#3__VACS___CountryService.htm">
                Información
            </a>
            <button id='close-button-alert' type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 order-lg-first order-md-first order-last">
                <div id='loading' class="alert alert-info d-none" role="alert">
                    Cargando...
                </div>
                <table class="table text-center" id='table-result'>
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Tipo de servicio</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Fecha de entrega</th>
                        </tr>
                    </thead>
                </table>
                <div id='alerta' class="alert alert-primary" role="alert"></div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="nav nav-tabs my-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="paquete-tab" data-toggle="tab" href="#paquete">Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="origen-tab" data-toggle="tab" href="#origen">Origen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="destino-tab" data-toggle="tab" href="#destino">Destino</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="paquete" role="tabpanel" aria-labelledby="paquete-tab">
                        <form id='formRate'>
                            <table class="table text-center">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col">Peso</th>
                                        <th scope="col">Alto</th>
                                        <th scope="col">Largo</th>
                                        <th scope="col">Ancho</th>
                                    </tr>
                                </thead>
                            </table>
                        </form>

                        <div class="row justify-content-center my-3">
                            <div class="col">
                                <button id='delete-last' class="btn btn-danger btn-sm btn-block">
                                    Eliminar último
                                </button>
                            </div>
                            <div class="col">
                                <button id='add-row' class="btn btn-success btn-sm btn-block">
                                    Agregar nueva fila
                                </button>
                            </div>
                            <div class="col">
                                <button id='confirm-data' class="btn btn-primary btn-sm btn-block">
                                    Confirmar datos
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="origen" role="tabpanel" aria-labelledby="origen-tab">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calle(s)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="origenCalles">
                                    <small id="emailHelp" class="form-text text-muted">Si es más de una calle, separarla por una coma</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ciudad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="origenCiudad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-7 col-form-label">Estado o código de provincia (2 dígitos)</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="origenEstado">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Código Postal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="origenCP">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="destino" role="tabpanel" aria-labelledby="destino-tab">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calle(s)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="destinoCalles">
                                    <small id="emailHelp" class="form-text text-muted">Si es más de una calle, separarla por una coma</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ciudad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="destinoCiudad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-7 col-form-label">Estado o código de provincia (2 dígitos)</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="destinoEstado">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Código Postal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="destinoCP">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/helpers.js"></script>
    <script src="js/main.js"></script>

</body>

</html>