@extends('admin.layouts.master_admin')
@section('content')

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Admin</h4>
          </div>
          <div class="card-body">
            10
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Nuevo</h4>
          </div>
          <div class="card-body">
            42
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Reportes</h4>
          </div>
          <div class="card-body">
            1,201
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-circle"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Usuarios en línea</h4>
          </div>
          <div class="card-body">
            1
          </div>
        </div>
      </div>
    </div>                  
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Statistics</h4>
          <div class="card-header-action">
            <div class="btn-group">
              <a href="#" class="btn btn-primary">Semana</a>
              <a href="#" class="btn">Meses</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <canvas id="myChart" height="182"></canvas>
          <div class="statistic-details mt-sm-4">
            <div class="statistic-details-item">
              <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
              <div class="detail-value">$243</div>
              <div class="detail-name">Ventas totales</div>
            </div>
            <div class="statistic-details-item">
              <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
              <div class="detail-value">$2,902</div>
              <div class="detail-name">Ventas semanales</div>
            </div>
            <div class="statistic-details-item">
              <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
              <div class="detail-value">$12,821</div>
              <div class="detail-name">Ventas mensuales</div>
            </div>
            <div class="statistic-details-item">
              <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
              <div class="detail-value">$92,142</div>
              <div class="detail-name">Ventas anuales</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Actividad reciente</h4>
        </div>
        <div class="card-body">             
          <ul class="list-unstyled list-unstyled-border">
            
            <li class="media">
              
              <div class="media-body">
                <div class="float-right">17m</div>
                <div class="media-title">Chepe Town</div>
                <span class="text-small text-muted">Publicó recetas de SUKO</span>
              </div>
            </li>
          </ul>
          <div class="text-center pt-1 pb-1">
            <a href="#" class="btn btn-primary btn-lg btn-round">
              Ver todo
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-5 col-md-12 col-12 col-sm-12">
      <form method="post" class="needs-validation" novalidate="">
        <div class="card">
          <div class="card-header">
            <h4>Borrador rápido</h4>
          </div>
          <div class="card-body pb-0">
            <div class="form-group">
              <label>Titulo</label>
              <input type="text" name="title" class="form-control" required>
              <div class="invalid-feedback">
                Please fill in the title
              </div>
            </div>
            <div class="form-group">
              <label>Contenido</label>
              <textarea class="summernote-simple"></textarea>
            </div>
          </div>
          <div class="card-footer pt-0">
            <button class="btn btn-primary">Subir</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-7 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Últimas publicaciones</h4>
          <div class="card-header-action">
            <a href="#" class="btn btn-primary">Ver todo</a>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Autor</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>                         
                <tr>
                  
                @foreach($products as $product)
                  <tr>
                    <td>
                      {{ $product->name }}
                      <div class="table-links">
                        en <a href="{{ route('allProducts') }}">Publicación del vendedor</a>
                        <div class="bullet"></div>
                        <a href="#">Ver</a>
                      </div>
                    </td>
                    <td>
                      <a class="rounded-circle mr-1">{{ $product->user->name }}</a>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                      <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tr>                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 
