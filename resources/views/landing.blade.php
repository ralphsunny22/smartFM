@extends('front.layouts.front_design')

@section('extra_css')
@endsection

@section('content')

<!--Content Main start-->
<div class="height-100 bg-light">
  <h5>Main Components</h5>
  <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col">
          <div class="card h-100">
            
            <div class="card-body text-center">
              <h6 class="card-title">Total Files</h6>
              <p class="card-text">10</p>
            </div>
          </div>
      </div>

      <div class="col">
        <div class="card h-100">
          
          <div class="card-body text-center">
            <h6 class="card-title">Total Files</h6>
            <p class="card-text">10</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
      
          <div class="card-body text-center">
            <h6 class="card-title">Total Files</h6>
            <p class="card-text">10</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          
          <div class="card-body text-center">
            <h6 class="card-title">Total Files</h6>
            <p class="card-text">10</p>
          </div>
        </div>
      </div>
  </div>

  <div class="mt-5">
      <h6>My Files</h6>
      <table id="myTable" class="table table-striped">
          <thead>
              <tr>
                  <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                  <th>File</th>
                  <th>Name</th>
                  <th>Size</th>
                  <th>Folder</th>
                  <th>Created</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              
          </thead>

          <tbody>
              <tr>
                  <td><input type="checkbox" name="" id=""></td>
                  <td>Img</td>
                  <td>image.jpg</td>
                  <td>10kb</td>
                  <td>images</td>
                  <td>2/22/22</td>
                  <td>active</td>
                  <td><i class="bx bx-show"></i> <i class="bx bx-edit"></i></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="" id=""></td>
                <td>Img</td>
                <td>image.jpg</td>
                <td>10kb</td>
                <td>images</td>
                <td>2/22/22</td>
                <td>active</td>
                <td><i class="bx bx-show"></i> <i class="bx bx-edit"></i></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="" id=""></td>
              <td>Img</td>
              <td>image.jpg</td>
              <td>10kb</td>
              <td>images</td>
              <td>2/22/22</td>
              <td>active</td>
              <td><i class="bx bx-show"></i> <i class="bx bx-edit"></i></td>
          </tr>
          </tbody>

          <tfoot>
              <tr>
                <th style="width: 5%"><input type="checkbox" name="" id=""></th>
                <th>File</th>
                <th>Name</th>
                <th>Size</th>
                <th>Folder</th>
                <th>Created</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>
      </table>
  </div>

  <div class="mt-5 d-none">
      <h6>All Files</h6>
      <div class="row row-cols-1 row-cols-md-5 g-4">
          <div class="col">
              <div class="card h-100">
              <div class="folder-files">
                  <img src="/assets/images/img1.jpg" class="card-img-top" alt="...">
              </div>
              
              <div class="card-body text-center">
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card h-100">
              <img src="/assets/images/pdf.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>

          <div class="col">
          <div class="card h-100">
              <img src="/assets/images/word.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
          <div class="col">
          <div class="card h-100">
              <img src="/assets/images/excel.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
          <div class="col">
          <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body text-center">
              <p class="card-text">This is a short card.</p>
              </div>
          </div>
          </div>
      </div>
  </div>
</div>
<!--Content Main start-->

@endsection

@section('extra_js')
@endsection

